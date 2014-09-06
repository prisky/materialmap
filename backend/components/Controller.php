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
use kartik\markdown\Markdown;
use backend\components\FieldRange;
use backend\components\DetailView;

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
	 * @var array of Excel format strings indexed by attribute
	 */
	public $excelFormats = [];
	
	/**
	 * Build array of grid columns for  use in grid view
	 * return array grid columns
	 */
	public function getGridColumns() {
		return [];
	}
	
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
                        'actions' => ['search'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],	// guests
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout', 'search'],
                        'roles' => ['@'],	// authorized
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'delete'],
                        'roles' => [$this->modelNameShort],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view', 'index', 'export', 'list'],
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
		$before = '<span></span>';		// seems to need something otherwise the export button doesn't show i.e. null  or empty won't work but space will
		$searchModel = new $this->modelNameSearch;
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->getPagination()->pageSize = 10;
		$gridColumns = $this->gridColumns;

		if(Yii::$app->user->can($this->modelNameShort)) {
			array_unshift($gridColumns, ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}']);
			$before = \yii\bootstrap\Button::widget([
				'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', ' New'),
				'options' => [
					'id' => 'modalButton',
					'class' => 'btn btn-success',
					'value' => Url::to(array_merge(['create'], $this->parentParam)),
				],
				'encodeLabel' => false
			]);
		}
		elseif(Yii::$app->user->can($this->modelNameShort . 'Read')) {
			array_unshift($gridColumns, ['class' => 'yii\grid\ActionColumn', 'template' => '{view}']);
		}

		return $this->render('@app/views/index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
			'gridColumns' => $gridColumns,
			'parentParam' => $this->parentParam,
			'before' => $before
		]);
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
			'mode' => DetailView::MODE_VIEW,
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
		
		// from http://www.yiiframework.com/wiki/690/render-a-form-in-a-modal-popup-using-ajax/
        return $this->renderAjax('//' . $this->id . '/_form', [
			'model' => $model,
			'mode' => DetailView::MODE_EDIT,
		]);
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
		
		return $this->render('@app/views/update', [
			'model' => $model,
		]);
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

		$columns = $this->gridColumns;
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
				if(isset($this->excelFormats[$attribute])) {
					$columnIndex = \PHPExcel_Cell::stringFromColumnIndex($col);
					$activeSheet->getStyle($columnIndex)->getNumberFormat()->setFormatCode($this->excelFormats[$attribute]);
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
	 * Produce list data for ajax return in Select2 widget
	 * @param string $q Search term the user enters - sent by ajax with each keypress
	 * @param int $page Page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param int $id Id of the model to load initially
	 */
	public function actionList($q = null, $page = null, $id = null) {
		$modelName = $this->modelName;
		$out = ['more' => false];

		if (!is_null($q)) {
			$query = $modelName::find()->displayAttributes($q, $page);
			$command = $query->createCommand();
			$data = $command->queryAll();
			$out['results'] = array_values($data);
			$out['total'] = $query->count();
		}
		elseif ($id > 0) {
			$model = $modelName::find()->where([$modelName::tableName() . '.id' => $id])->displayAttributes()->one();
			$out['results'] = ['id' => $id, 'text' => $model->text];
		}
		else {
			$out['results'] = ['id' => 0, 'text' => 'No matching records found'];
		}
	
		echo \yii\helpers\Json::encode($out);
	}
	
	/**
	 * Produce the list contents for the search box results - called by ajax
	 * @param string $q Search term the user enters - sent by ajax with each keypress
	 * @param int $p Page number of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param string $m The short name of the model to continue from
	 * @param type $l The overall line number to continue from - including headings
	 * @param int $o The offset for the next select to continue from
	 */
	public function actionSearch($q, $p = 1, $m = '', $l = 0, $o = 0) {
		
//TODO: the little code below is an attempt to cancel the connection by echoing output - however script refuses to cancel - not sure if
// mamp problem. This needs to cancel to save overhead of fast typing meaning severals requests live the abort sent by ajax
/*		ignore_user_abort(false); // just to be safe

		ob_start();
		echo 'sdgf ';
		flush();
		ob_flush();

		$t = connection_status();*/
		// if the search term is not empty
		if($q) {
			ob_start();
			$pageSize = 15;
			$upperLimit = $pageSize * $p;
			$lowerLimit = $upperLimit - $pageSize;
			$lineNumber = $l;

			// loop through all models
			foreach(Model::find()->asArray()->all() as $model) {
				$hasOpenUl = false;
				$modelNameShort = $model['auth_item_name'];
				// if auto next - i.e. a starting point model has been passed in
				if($m) {
					// skip to our correct starting model
					if($modelNameShort != $m) continue;
					$m = null;
				}

				if(Yii::$app->user->can($modelNameShort)) {
					$action = strtolower($modelNameShort) . '/update';
				}
				elseif(Yii::$app->user->can($modelNameShort. 'Read')) {
					$action = strtolower($modelNameShort) . '/view';
				}
				else {
					$action = null;
				}

				if($action) {
					$modelName = "\\common\models\\$modelNameShort";
					// continue we we presiously left off if possible i.e. this from auto next
					if($o) {
						$offset = $o;
						$o = 0;
					}
					// otherwise calculate how many we are going to jump over to save having to iterate through those records
					elseif(($offset = ($lowerLimit - $lineNumber)) < 0) {
						$offset = 0;
					}
					// calculate the maximum rows needed
					if(($limit = ($upperLimit - $lineNumber)) > $pageSize) {
						$limit = $pageSize;
					}
					$query = $modelName::find()->displayAttributes($q);
					$searchResults = $query->limit($limit)->offset($offset)->createCommand()->queryAll();
					
					$showHeader = !$offset;

					if($searchResults) {
						// keep running total of offset for next link
						$offset++;
						// if at end
						if(++$lineNumber == $upperLimit) break 1;
						// only show header if start of a new model
						if($showHeader) {
							echo "<h3 data-page='$p'>{$model['label']}</h3>\n";
						}

						foreach($searchResults as $searchResult) {
							$offset++;
							// if hitting upper limit
							if(++$lineNumber == $upperLimit) break 2;

							if(!$hasOpenUl) {
								echo "<ul>\n";
								$hasOpenUl = true;
							}
							echo "\t<li data-page='$p'><a href='" . Url::toRoute([$action, 'id'=>$searchResult['id']]) . "'><span class='description'>{$searchResult['text']}</span></a></li>\n";
						}

						if($hasOpenUl) {
							$hasOpenUl = false;
							echo "</ul>\n";
						}
					}
				}
			}

			if($hasOpenUl) {
				echo "</ul>\n";
			}
			
			if($output = ob_get_clean()) {
				$url = Url::toRoute('search')
					. '&q=' . Html::encode($q)
					. '&p=' . ($p + 1)
					. "&m=$modelNameShort"
					. "&l=$lineNumber"
					. "&o=$offset";

				echo "$output
					<a id='next' class='hidden' data-page='$p' href='$url'></a>
					<script type='text/javascript' charset='utf-8'>
						$('#search-resultbox').jscroll();
					</script>";
			}
			elseif(!$lineNumber) {
				echo "<h3>Nothing found</h3>";
			}
		}
		// otherwise empty so returning help for current context
		else {
			$model = Model::findOne(['auth_item_name' => $this->modelNameShort]);
			// heading - model
			echo '<div class="table-responsive modal-body">';
			echo '<h1> '. Markdown::convert($model->label) . '</h1>';
			echo '<p>' . Markdown::convert($model->help) . '</p>';
			echo '<table class="detail-view table table-hover table-bordered table-striped">';
			echo '<tbody>';
			// table of attributes
			foreach($model->columns as $column) {
				echo "<tr>";
				echo "<th>{$column->label}</th>";
				echo "<td>" . Markdown::convert($column->help) . "</td";
				echo "/<tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo "</div>";
			// need to unbind jscroll which happens if no link for jscroll to take next url from
			echo "
				<script type='text/javascript' charset='utf-8'>
					$('#search-resultbox').unbind('.jscroll');
				</script>";
		}
	}

	/**
	 * Calculate the parent parameter from a get variable
	 * @return array The get paramter of the parent if possible
	 */
	public function getParentParam()
	{
		$fullModelName = $this->modelName;
	
		// if not a root node in navigation
		if($parentForeignKeyName = $fullModelName::getParentForeignKeyName()) {
			$parentForeignKey = isset($_GET[$parentForeignKeyName]) ? $_GET[$parentForeignKeyName] : NULL;
			return [$parentForeignKeyName => $parentForeignKey];
		}
		
		return [];
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
				$parentModelName = "\\common\models\\" . $parentModel['auth_item_name'];
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
	public static function fKWidgetOptions ($shortModelName)
	{
		// The controller action that will render the list
		$url = Url::toRoute(strtolower($shortModelName) . '/list');

// Script to initialize the selection based on the value of the select2 element
$initScript = <<< SCRIPT
function (element, callback) {
    var id=$(element).val();
    if (id !== "") {
        $.ajax("{$url}&id=" + id, {dataType: "json"}).done(function(data) { callback(data.results);});
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
				'initSelection' => new JsExpression($initScript),
			],	
		];
	}
	
}
