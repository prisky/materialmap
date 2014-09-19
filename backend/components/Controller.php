<?php

namespace backend\components;

use Yii;
use yii\web\NotFouactioncndHttpException;
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
	 * @param ActiveRecord $searchModel Model with attributes sit to get paramters from if necassary
	 * @return type
	 */
	public function gridColumns($searchModel) {
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
		// load search param
		$searchModel->load(Yii::$app->request->queryParams);
		// load get parameters that may limit by account id etc
		$searchModel->setAttributes(Yii::$app->request->queryParams);

		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->getPagination()->pageSize = 10;
		$gridColumns = $this->gridColumns($searchModel);

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
	 * Creates a new model and set defaults
	 * @return ActiveRecord the new model
	 */
	public function getNewModelWithDefaults()
	{
		$model = new $this->modelName;
		$databaseName = Yii::$app->params['defaultSchema'];
		$tableName = $model->tableName();
 		$results = Yii::$app->db->createCommand("
			SELECT COLUMN_NAME, COLUMN_DEFAULT
			FROM information_schema.COLUMNS
			WHERE TABLE_SCHEMA = '$databaseName'
				AND TABLE_NAME = '$tableName'")->queryAll();
		$safeAttributes = $model->safeAttributes();
		foreach($results as $result) {
			$attribute = $result['COLUMN_NAME'];
			if(in_array($attribute, $safeAttributes)) {
				$model->$attribute = $result['COLUMN_DEFAULT'];
			}
		}
		
		return $model;
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = $this->newModelWithDefaults;
		
		$modelNameShort = $this->modelNameShort;
		
		$model->load(Yii::$app->request->get());
		if($model->load(Yii::$app->request->post()) && $model->save())
		{
			// if this model ia leaf node in navigation
			if($this->isLeaf()) {
				// go to the admin view of this node
				$fullModelName = $this->modelName;
				$parentAttribute = $fullModelName::parentAttribute();
				$parentForeignKey = isset($_GET[$parentAttribute]) ? $_GET[$parentAttribute] : NULL;
				return $this->redirect(['index', $parentAttribute => $parentForeignKey]);
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
			if($parentAttribute = $fullModelName::parentAttribute()) {
				$params[$parentAttribute] = $model->$parentAttribute;
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
		// load search param
		$searchModel->load($queryParams);
		// load get parameters that may limit by account id etc
		$searchModel->setAttributes($queryParams);
		$dataProvider = $searchModel->search();
		$dataProvider->pagination = false;
		$columns = $this->gridColumns($searchModel);
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
		$row = 2;
		foreach($dataProvider->models as $model) {
			$col = 0;
			foreach($columns as $column) {
				if(isset($column['attribute'])) {
					$attribute = $column['attribute'];
					if(isset($column['filterType']) && $column['filterType'] == GridView::FILTER_SELECT2) {
						// this uses a hack of inserting the related model name into plugin options as gets thru without erroring whereas
						// putting this into GridColumns where it should be causes un "undefined attribute" error
						$relatedModelName = '\\common\\models\\' . $column['filterWidgetOptions']['pluginOptions']['relatedModelNameShort'];
						$value = $relatedModelName::label($model->$attribute);
					}
					else {
						$value = $model->$attribute;
					}
					$activeSheet->setCellValueByColumnAndRow($col++, $row, $value);
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
	 * Produce list data for ajax return in Select2 widget - see fkWidgetOptions also
	 * @param array $w Where conditions where attribute => value
	 * @param string $q Search term the user enters - sent by ajax with each keypress
	 * @param int $page Page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param int $id Id of the model to load initially
	 */
	public function actionList($w = [], $q = null, $page = null, $id = null) {
		$modelName = $this->modelName;
		$out = ['more' => false];

		if (!is_null($q)) {
			$query = $modelName::find()->andWhere($w)->display($q, $page);
			$command = $query->createCommand();
			$data = $command->queryAll();
			$out['results'] = array_values($data);
			$out['total'] = $query->count();
		}
		elseif ($id > 0) {
			$model = $modelName::find()->where([$modelName::tableName() . '.id' => $id])->andWhere($w)->display()->one();
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
					$query = $modelName::find()->display($q);
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
		if($parentAttribute = $fullModelName::parentAttribute()) {
			$parentForeignKey = isset($_GET[$parentAttribute]) ? $_GET[$parentAttribute] : NULL;
			return [$parentAttribute => $parentForeignKey];
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
	 * Builds breadcrumbs using the tbl_model_tree closure table and working back from the current url.
	 * @return array the breadcrumbs
	 */
	public function getBreadCrumbs($home = false)
	{
		$breadcrumbs = [];

		// get the model name associated with this controller
		$modelName = $this->modelName;
		$updateModel = $adminModel = null;

		// Need to find a starting place
		if(!empty($_GET['id'])) {
			$updateModel = $modelName::findOne($_GET['id']);
		}
		else {
			$adminControllerName = strtolower($this->modelNameShort);
			// if the model has a parent in our navigation structure
			if($parentAttribute = $modelName::parentAttribute()) {
				$updateModelName = '\\common\\models\\' . $modelName::parentName();
				$updateModel = $updateModelName::findOne($_GET[$parentAttribute]);
				$breadcrumbs[] = ['label' => $this->labelPlural(), 'url' => Yii::$app->request->absoluteUrl];
			}
			// otherwise no parent
			else {
				// top level
				$breadcrumbs[] = ['label' => $this->labelPlural(), 'url' => ["/$adminControllerName"]];
			}
		}

		// create the breadcrumbs - starting from the end and working towards the root
		while($updateModel || $adminModel) {
			// update or view link
			if(isset($updateModel)) {
				$updateControllerName = strtolower($updateModel->modelNameShort);
				$breadcrumbs[] = ['label' => $updateModel->label, 'url' => ["$updateControllerName/update", 'id' => $updateModel->id]];
				// setup model for next item back towards root which will be a grid view page
				$adminModel = $updateModel;
			}

			// grid view link - there is always one of these above every update link - and if maybe one at end if no update linke
			$adminControllerName = strtolower($adminModel->modelNameShort);
			$parentAttribute = $adminModel::parentAttribute();
			$params = empty($parentAttribute) ? [] : [$parentAttribute => $adminModel->$parentAttribute];
			$breadcrumbs[] = ['label' => $adminModel->labelPlural(), 'url' => ["/$adminControllerName"] + $params];
			// setup model for next item back towards root which will be an update or view page
			$updateModel = $adminModel->parentModel;
			$adminModel = null;
		}

		// add home link
		$breadcrumbs[] = ['label' => Yii::t('app', 'Home'), 'url' => ["site/index"]];
		// reverse the order of the breadcrumbs so working in correct order
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
			$parentAttribute = $fullModelName::parentAttribute();
			// all tabs will need this value for a parameter
			$primaryKey = isset($_GET[$parentAttribute]) ? $_GET[$parentAttribute] : NULL;
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
			$parentAttribute = $modelName::parentAttribute();

			$url[$parentAttribute] = $primaryKey;
			
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
	 * controller action in the child class to handle the ajax request. Mallory could alter the value of the where paramters but as account
	 * scope will be applied this shouldn't be important though if turns out to be an issue then return data must be controlled to RBAC.
	 * @param type $shortModelName
	 * @param array $where Scope conditions array where attribute => value
	 * @return array Widget options
	 */
	public static function fKWidgetOptions ($shortModelName, $where = [])
	{
		// The controller action that will render the list
		$url = Url::toRoute([strtolower($shortModelName) . '/list', 'w' => $where]);

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
				// this uses a hack of inserting the related model name into plugin options as gets thru without erroring whereas
				// putting this into GridColumns where it should be causes un "undefined attribute" error
				'relatedModelNameShort' => $shortModelName,
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
