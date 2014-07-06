<?php

namespace backend\components;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Model;
use yii\web\JsExpression;
use yii\helpers\Inflector;
use yii\helpers\VarDumper;
use common\models\Column;
use kartik\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
/**
 * Controller is the base class of app controllers and implements the CRUD actions for a model.
 *
 * @author Andrew Blake <admin@newzealandfishing.com>
 */
abstract class Controller extends \common\components\Controller
{

	/**
	 * @var string the model name of the search class with namespace
	 */
	public $modelNameSearch;
	
	/**
	 * @inheritdoc
	 */
	public function __construct($id, $module, $config = [])
	{
		parent::__construct($id, $module, $config = []);

		// Needs to be after call to parent constructor
		$this->modelNameSearch = static::modelNameSearch();
	}

	private static function modelNameSearch()
	{
		return "\\backend\\models\\" . static::modelNameShort() . 'Search';
	}

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],	// guests
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],	// authorized
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'delete'],
                        'roles' => [$this->modelNameShort],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view', 'index', 'export', $this->modelNameShort . 'list'],
                        'roles' => [$this->modelNameShort . 'Read'],
                    ],
                ],
            ],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}

	/**
	 * Lists all models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new $this->modelNameSearch;
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('@app/views/index', [
				'dataProvider' => $dataProvider,
				'searchModel' => $searchModel,
				'gridColumns' => $this->gridColumns,
		]);
	}

	/**
	 * List of columns to show in index view - grid.
	 * @param bool $includeNumberFormat true if want number format for export to excel - not accepted by kartik\grid\GridView
	 * @return array
	 */
	protected function getGridColumns($includeNumberFormat = false)
	{
		$modelName = $this->modelName;
		$modelNameShort = $this->modelNameShort;
		$tableSchema =  Yii::$app->db->getTableSchema($modelName::tableName());
 		$columns = $tableSchema->columns;

 		// get all columns that have labels
		$attributes = Column::find()
			->joinWith('model')
			->where(['auth_item_name' => $modelNameShort])
			->asArray()
			->all();
		
		if(Yii::$app->user->can($modelNameShort)) {
			$gridColumns[] = ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'];
		}
		elseif(Yii::$app->user->can($modelNameShort . 'Read')) {
			$gridColumns[] = ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'];
		}

		foreach($attributes as $attribute) {
			$numberFormat = false;
			$attribute = $attribute['name'];
				
			$column = $columns[$attribute];

			$gridColumn = ['attribute' => $attribute];

			// exlude some columns
			switch($attribute) {
				case 'id' :
				// exclude the parent foreign key
				case $modelName::getParentForeignKeyName() :
				case 'deleted' :
				case 'created' :
				case 'account_id' :
					continue 2;
			}

			if (preg_match('/(password|pass|passwd|passcode)/i', $attribute)) {
				continue;
			}
			elseif ($column->type == 'decimal' && preg_match('/(amount|charge|balance)/i', $attribute)) {
				$gridColumn['filterType'] = GridView::FILTER_MONEY;
				$numberFormat = '$#,##0.00;[Red]-$#,##0.00';
			}
			elseif ($column->type == 'decimal' && preg_match('/(rate)$/i', $attribute)) {
				$gridColumn['filterType'] = GridView::FILTER_SPIN;
				$numberFormat = '0.00%';
			}
			elseif (is_array($column->enumValues) && count($column->enumValues) > 0) {
				$dropDownOptions = [];
				foreach ($column->enumValues as $enumValue) {
					$dropDownOptions[$enumValue] = Inflector::humanize($enumValue);
				}
				$gridColumn['class'] = 'dropDownList';
				$gridColumn['filterWidgetOptions'] = [
					'options' => ['prompt' => ''],
					'items' => preg_replace("/\n\s*/", ' ', VarDumper::export($dropDownOptions))
				];
			}
			else {
				if($column->type == 'integer') {
					// if the field is a foreign key
					foreach($tableSchema->foreignKeys as $tableKeys) {
						if(isset($tableKeys[$column->name])) {
							$gridColumn['filterType'] = GridView::FILTER_SELECT2;
							$gridColumn['filterWidgetOptions'] =
								$this->fKWidgetOptions(Inflector::id2camel(str_replace('tbl_', '', $tableKeys[0]), '_'));
							$gridColumn['value'] = function ($model, $key, $index, $widget) {
								if(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->label($key), Url::toRoute([strtolower($model->modelNameShort) . '/update', 'id' => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . 'Read')) {
									return Html::a($model->label($key), Url::toRoute([strtolower($model->modelNameShort) . '/read', 'id' => $key]));
								}
								else {
									return $model->label($key);
								}
							};
							$gridColumn['format'] = 'raw';
							break;
						}
					}
				}

				if(!isset($gridColumn['filterType'])) {
					switch($column->dbType) {
						case 'tinyint(1)' :
							$gridColumn['class'] = 'kartik\grid\BooleanColumn';
							$numberFormat = '[=0]"No";[=1]"Yes"';
							break;
						case 'date' :
							$gridColumn['filterType'] = GridView::FILTER__DATE;
							$numberFormat = 'mmmm d", "yy';
							break;
						case 'time' :
							$gridColumn['filterType'] = GridView::FILTER_TIME;
							$numberFormat = 'hh:mm AM/PM';
							break;
						case 'datetime' :
						case 'timestamp' :
							$gridColumn['filterType'] = GridView::FILTER_DATETIME;
							$numberFormat = 'hh:mm AM/PM on mmmm d, yy';
					}
				}
			}
			
			if($includeNumberFormat && $numberFormat) {
				$gridColumn['numberFormat'] = $numberFormat;
			}
			$gridColumns[] = $gridColumn;
		}

		return $gridColumns;
	}

	/**
	 * Displays a single model.
	 * @param string $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		return $this->render('//' . $this->id . '/_form', [
			'model' => $this->findModel($id),
			'mode' => \backend\components\DetailView::MODE_VIEW,
		]);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new $this->modelName;

		if($model->load(Yii::$app->request->post()) && $model->save())
		{
			// if this model ia leaf node in navigation
			if($this->isLeaf()) {
				// go to the admin view of this node
				$fullModelName = $this->modelName;
				$parentForeignKeyName = $fullModelName::getParentForeignKeyName();
				$parentForeignKey = isset($_GET[$parentForeignKeyName]) ? $_GET[$parentForeignKeyName] : NULL;
				return $this->redirect(['index', $parentForeignKeyName => $parentForeignKey]);
			}
			else {
				// go to the update view
				return $this->redirect(['update', 'id' => $model->id]);
			}
		}
	}

	/**
	 * Updates an existing model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if($model->load(Yii::$app->request->post()) && $model->save())
		{
			// redirect back to parent admin view
			$params[] = 'index';
			$fullModelName = $this->modelName;
			if($parentForeignKeyName = $fullModelName::getParentForeignKeyName()) {
				$params[$parentForeignKeyName] = $model->$parentForeignKeyName;
			}
			
			return $this->redirect($params);
		}
		else
		{
			return $this->render('@app/views/update', [
					'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

    /**
     * Download the exported file
     */
    public function actionExport()
    {
        $this->setHttpHeaders(Yii::$app->request->bodyParams['export_filetype'], $this->id);

		$searchModel = new $this->modelNameSearch;
		$queryParams = Yii::$app->request->queryParams;
		if(isset($queryParams['page'])) {
			unset($queryParams['page']);
		}

		$columns = $this->getGridColumns(true);
		$objPHPExcel = new \PHPExcel();
		$activeSheet = $objPHPExcel->setActiveSheetIndex(0);
		$modelName = $this->modelName;
		$activeSheet->setTitle($modelName::label());

		// headings
		$col = 0;
		$objPHPExcel->getActiveSheet()->getStyle(1)->getFont()->setBold(true);
		foreach($columns as $column) {
			if(isset($column['attribute'])) {
				$attribute = $column['attribute'];
				if(isset($column['numberFormat'])) {
					$columnIndex = \PHPExcel_Cell::stringFromColumnIndex($col);
					$activeSheet->getStyle($columnIndex)->getNumberFormat()->setFormatCode($column['numberFormat']);
				}
				$activeSheet->setCellValueByColumnAndRow($col++, 1, $modelName::attributeLabel($attribute));
			}
		}

		// data
		$dataProvider = $searchModel->search($queryParams);
		$dataProvider->pagination = false;
		$row = 2;
		foreach($dataProvider->models as $model) {
			$col = 0;
			foreach($columns as $column) {
				if(isset($column['attribute'])) {
					$attribute = $column['attribute'];
					$activeSheet->setCellValueByColumnAndRow($col++, $row, $model->$attribute);
				}
			}
			$row++;
		}

		$writerType = (Yii::$app->request->bodyParams['export_filetype'] == GridView::EXCEL) ? 'Excel5' : 'CSV';
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, $writerType);
		ob_start();
		$objWriter->save('php://output');
		
		return ob_get_clean();
    }
	
    /**
     * Sets the HTTP headers needed by file download action.
     */
    private function setHttpHeaders($type, $name)
    {
        $mime = ($type == GridView::CSV) ? 'text/csv' : 'application/vnd.ms-excel';

        Yii::$app->getResponse()->getHeaders()
                 ->set('Pragma', 'public')
                 ->set('Expires', '0')
                 ->set('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
                 ->set('Content-Disposition', 'attachment; filename="' . $name . '.' . $type . '"')
                 ->set('Content-type', $mime . '; charset=utf-8');
    }

	/**
	 * Finds the model based on its primary key value.
	 * If the model not found, a 404 HTTP exception will be thrown.
	 * @param string $id
	 * @return ActiveRecord the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		$modelName = $this->modelName;

		if(($model = $modelName::findOne($id)) === null) {
			throw new NotFoundHttpException('The requested page does not exist.');
		}

		return $model;
	}

	/**
	 * Builds breadcrumbs using the tbl_navigation closure table and working back from the current url.
	 * @return array the breadcrumbs
	 */
	public function getBreadCrumbs($home = false)
	{
		// Model extends ClosureTableActiveRecord
		$model = Model::findOne(['auth_item_name' => $this->modelNameShort]);
		$models = Model::find()
			->select([$model->tableName() . '.id', 'auth_item_name'])
			->pathOf($model->id)
			->asArray()
			->all();

		// Need to find a starting place
		// If update/view then use id 
		if(!empty($_GET['id'])) {
			$primaryKey = $_GET['id'];
		}
		//otherwise gridview so find foreign key to parent if not top level
		else {
			$fullModelName = $this->modelName;
			$parentForeignKeyName = $fullModelName::getParentForeignKeyName();
			$parentKey = isset($_GET[$parentForeignKeyName]) ? $_GET[$parentForeignKeyName] : NULL;
		}

		// reverse the order of the models so working from end backwards
		$models = array_reverse($models);

		// create the breadcrumbs
		$breadcrumbs = [];
		foreach($models as $key => $model) {
			$modelName = "\\common\models\\" . $model['auth_item_name'];
			$controller = strtolower($model['auth_item_name']);

			// update or view link
			if(isset($primaryKey)) {
				$params = ['id' => $primaryKey];
				$breadcrumbs[] = ['label' => $modelName::label($primaryKey), 'url' => ["$controller/update"] + $params];
			}

			// grid view link
			if(isset($parentKey)) {
				$primaryKey = $parentKey;
			}
			$params = empty($parentForeignKeyName) ? [] : [$parentForeignKeyName => $parentKey];
			$breadcrumbs[] = ['label' => $modelName::labelPlural(), 'url' => ["/$controller"] + $params];
			
			// Prepare for next iteration. Primary key should be set to the foreign key in this models parent to the grandparent
			if(sizeof($models) > $key + 2) {
				$parentModel = $models[$key + 1];
				$parentModelName = "\\common\models\\" . $model['auth_item_name'];
				$grandparentForeignKeyName = $parentModelName::getParentForeignKeyName();
				$parentKey = $parentModelName::findOne($parentKey)->$grandparentForeignKeyName;
			}
		}

		// reverse the order of the breadcrumbs so working in correct order
		$breadcrumbs[] = ['label' => Yii::t('app', 'Home'), 'url' => ["site/index"]];
		$breadcrumbs = array_reverse($breadcrumbs);

		// remove the link from the last item so just label - this is the active page
		end($breadcrumbs);
		$breadcrumbs[key($breadcrumbs)]['url'] = NULL;
		reset($breadcrumbs);

		return $breadcrumbs;
	}

	/**
	 * Get the tabs which are the current pages content as active and inactive tabs are the sibling options in navigation
	 * @return [] the 
	 */
	public function tabs($content)
	{
		$tabs = [];

		$model = Model::findOne(['auth_item_name' => $this->modelNameShort]);
		
		// if update/view then should see children nodes as tabs for index view and this node as update/view
		if(!empty($_GET['id'])) {
			// get child nodes
			$models = Model::find()
				->select([$model->tableName() . '.id', 'auth_item_name'])
				->childrenOf($model->id)
				->asArray()
				->all();
			// all tabs will need this value for a parameter
			$primaryKey = $_GET['id'];
			
			// check the users rights to see how to show the detail view
			$action = Yii::$app->user->can($this->modelName) ? 'update' : 'view';
			
			// set first tab to an update/view view
			$tabs[] = [
				'label' => static::labelShort($primaryKey),
				'content' => $content,
				'linkOptions' => ['href' => ["{$this->id}/$action", 'id' => $primaryKey]],
				'active' => TRUE,
			];
		}
		// otherwise sibling nodes all as index view
		else {
			// get siblings - including this node
			$models = Model::find()
				->select([$model->tableName() . '.id', 'auth_item_name'])
				->siblingsOf($model->id, TRUE)
				->asArray()
				->all();
			$fullModelName = $this->modelName;
			$parentForeignKeyName = $fullModelName::getParentForeignKeyName();
			// all tabs will need this value for a parameter
			$primaryKey = isset($_GET[$parentForeignKeyName]) ? $_GET[$parentForeignKeyName] : NULL;
		}

		// create the tabs
		foreach($models as $model)
		{
			$modelNameShort = $model['auth_item_name'];
			// if no read access for this user for this model
			if(!Yii::$app->user->can($modelNameShort . 'Read'))	{
				// skip this model i.e. no tab
				continue;
			}	
			$modelName = "\\common\models\\$modelNameShort";
			$controller = strtolower($modelNameShort);
			
			$url = ["/$controller"];
			
			// get the foreign key in this to the parent
			$parentForeignKeyName = $modelName::getParentForeignKeyName();

			$url[$parentForeignKeyName] = $primaryKey;
			
			// is this the active tab
			$active = ($modelNameShort == $this->modelNameShort);
			
			// create the tab
			$tab = [
				'label' => $modelName::labelPlural(),
				'content' => $active ? $content : '',
				'linkOptions' => ['href' => $url],
				'active' => $active,
			];
			
			// append tab
			$tabs[] = $tab;
		}
		
		return $tabs;
	}

	/**
	 * Produce widget options for a Select2 widget for a foreign key field. @see kartik\detail\DetailView and
	 * described at @link http://ivaynberg.github.io/select2/. These options provide infinite scrolling via ajax and require a
	 * controller action in the child class to handle the ajax request.
	 * @return array Widget options
	 */
	public function fKWidgetOptions ($shortModelName)
	{
		// The controller action that will render the list
		$url = \yii\helpers\BaseUrl::toRoute(strtolower($shortModelName) . 'list');

// Script to initialize the selection based on the value of the select2 element
$initScript = <<< SCRIPT
function (element, callback) {
    var id=$(element).val();
    if (id !== "") {
        $.ajax("{$url}?id=" + id, {dataType: "json"}).done(function(data) { callback(data.results);});
    }
}
SCRIPT;

$dataScript = <<< SCRIPT
function (term, page) {
	return {
		q: term,
		page_limit: 10,
		page: page,
	};
}
SCRIPT;
		
$resultsScript = <<< SCRIPT
function (data, page) {
	var more = (page * 10) < data.total;

	return {
		results: data.results,
		more: more
	};
}
SCRIPT;

	return [
			'pluginOptions' => [
				'allowClear' => true,
				'ajax' => [
					'url' => $url,
					'dataType' => 'json',
					'data' => new JsExpression($dataScript),
					'results' => new JsExpression($resultsScript),
				],
				'initSelection' => new JsExpression($initScript)
			],
		];
	}
	
	/**
	 * Produce widget options for a Select2 widget for user_id foreign key field referencing the tbl_user table
	 * @param string $name The short model of the referenced/parent model
	 * @param string $q Search term the user enters - sent by ajax with each keypress
	 * @param int $page Page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param int $id Id of the model to load initially
	 */
	protected function foreignKeylist($foreignKeyModelNameShort, $q = null, $page = null, $id = null) {
		$foreignKeyModelName = '\\common\\models\\' . $foreignKeyModelNameShort;
		$out = ['more' => false];

		if (!is_null($q)) {
			$query = $foreignKeyModelName::find()
				->displayAttributes($q, $page);
			$command = $query->createCommand();
			$data = $command->queryAll();
			$out['results'] = array_values($data);
			$out['total'] = $query->count();
		}
		elseif ($id > 0) {
			$out['results'] = ['id' => $id, 'text' => $foreignKeyModelName::find($id)->displayAttributes()];
		}
		else {
			$out['results'] = ['id' => 0, 'text' => 'No matching records found'];
		}
	
		echo \yii\helpers\Json::encode($out);
	}
}
