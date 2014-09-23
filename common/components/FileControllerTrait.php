<?php

namespace common\components;

use dosamigos\fileupload\UploadHandler;

/**
 * FileControllerTrait adds file upload functionality to a controller. To be used in conjuction with FileActiveRecordTrait and
 * dosamigos\fileupload\FileUploadUI, a Yii2 Widget encapsulating http://blueimp.github.io/jQuery-File-Upload/
 *
 * @author Andrew Blake <admin@newzealandfishing.com>
 */
trait FileControllerTrait {

	private $uploadHandler;

	/**
	 * Initialize the upload handler provided by http://blueimp.github.io/jQuery-File-Upload/. This will ensure the existance of our
	 * destination uploads directory
	 * @param ActiveRecord $model The model
	 */
	private function initUploadHandler($model)
	{
		// ensure distination directory exists - the whole way
		$path = Model::find()
			->select(['auth_item_name'])
			->pathOf(Model::findOne(['auth_item_name' => $this->modelNameShort])->id)
			->asArray()
			->all();
		$uploadDir = Yii::$app->params['privatePermanentUploadsPath'];
		foreach($path as $directory) {
			$fullpath .= "/$directory";
			exec("mkdir $uploadDir");
		}
		exec("mkdir $uploadDir/{$model->id}");

		$this->uploadHandler = new UploadHandler(array(
			'upload_dir' => $uploadDir,
			'upload_url' => $model->expose(),
			'script_url' => Url::to(['upload', 'id'=>$model->id]),
			'delete_type' => 'POST',
			'image_versions'=>array('thumbnail'=>array(
				'upload_url' => Yii::app()->params['webUploadPath'] . "{$this->modelNameShort}/$model->id/thumbnails/",
				'max_width' => '80px',
				'max_height' => '80px',
			))
 		));
	}

	public function behaviors()
	{
		parent::accessRules();
			array_unshift($accessRules,
				array('allow',
					'actions' => array('upload'),
					'roles' => array($this->modelName),
				),
				array('allow',
					'actions' => array('getExisting'),
					'roles' => array("{$this->modelName}Read"),
				)
			);

		return $accessRules;
	}

	public function actionGetExisting($id)
	{
		header('Pragma: no-cache');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Content-Disposition: inline; filename="files.json"');
		header('X-Content-Type-Options: nosniff');
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
		header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');
		$this->initUploadHandler($id);
	}
	
	public function actionUpload($id)
	{
		if(isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE')
		{
			$this->initUploadHandler($_GET['id']);
        }
		else
		{
			// if creating
			if(empty($_POST[$this->modelName]['id']))
			{
				$this->initUploadHandler($_POST[$this->modelName]['created']);
			}
			// otherwise updating
			else
			{
				$this->actionUpdate($_POST[$this->modelName]['id']);
			}
        }
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * This differs from parent in that the submit actually done inside the validate - submit should now never occur as aftervalidate will jquery
	 * will return false after finished processing - allowing jquery file upload's submit to upload files if required.
	 */
	//public function actionCreate($modal_id = 'myModal', &$model = null)
	
}

?>