<?php

namespace common\components;

use Yii;
use dosamigos\fileupload\UploadHandler;
use yii\helpers\Url;

/**
 * FileControllerTrait adds file upload functionality to a controller. To be used in conjuction with FileActiveRecordBehavior and
 * dosamigos\fileupload\FileUploadUI, a Yii2 Widget encapsulating http://blueimp.github.io/jQuery-File-Upload/
 *
 * @author Andrew Blake <admin@newzealandfishing.com>
 */
trait FileControllerTrait {
	/**
	 * Initialize the upload handler provided by http://blueimp.github.io/jQuery-File-Upload/. This will ensure the existance of our
	 * destination uploads directory
	 * @param ActiveRecord $model The model
	 */
	public function initUploadHandler($model, $options = [])
	{
		// ensure destination directory exists - this will mean that if an ancestor gets deleted then everything below will too
		$path = $model->uploadsPath;
		$privatePermanentUploadsPath = Yii::$app->params['privatePermanentUploadsPath'] . $path;
		exec("mkdir -p $privatePermanentUploadsPath");

		$options = $options + [
			'upload_dir' => $privatePermanentUploadsPath . '/',
			'upload_url' => $model->publish() . '/',
			'script_url' => Url::to(['upload', 'id'=>$model->primaryKey]),
			'delete_type' => 'POST',
			'image_versions'=>array('thumbnail'=>array(
				'upload_url' => $model->publish() . "/thumbnail/",
				'max_width' => '80px',
				'max_height' => '80px',
			))
 		];
			
		// initialize the upload handler
		return new UploadHandler($options);
	}

	/**
	 * Because a form can only have one action associated to it, any of the main buttons will cause this action to fire so we need
	 * to examine the request a bit to find out what our desired course of action really is 
	 */
	public function actionUpload($id = null)
	{
		// the UploadHandler from blueImp will take care of this type
		// of delete which is just a file delete and not a delete of our ActiveRecord model hence don't want to hand of to action delete
		// but just let UploadHandler do its work removing any identifying files
		// Alternately if get request then probably wanting something like a list of files as a JSON object
		if((isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') || Yii::$app->request->isGet) {
			$modelName = $this->modelName;
			$this->initUploadHandler($modelName::findOne($id));
        }
		// otherwise a post request - update or create action
		else {
			// if updating -- id passed
			if($id) {
				$this->actionUpdate($id);
			}
			// otherwise creating -- no id
			else {
				$this->actionCreate();
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

		if($model->load(Yii::$app->request->post())) {
			// handle files and buffer the response
			$uploadHandler = $this->initUploadHandler($model, ['print_response' => false]);
			// if no upload errors and successful in saving
			if(!$uploadHandler->has_errors && $model->save()) {
				// redirect back to parent admin view
				$params[] = 'index';
				$fullModelName = $this->modelName;
				if($parentAttribute = $fullModelName::parentAttribute()) {
					$params[$parentAttribute] = $model->$parentAttribute;
				}
			
				// generate a responece to this ajax request inititiated by jquery-file_upload plugin and incorporate
				// a redirect parameter the json object for use in our fileuploadstopped callback
				$uploadHandler->generate_response($uploadHandler->response_content + ['redirect' => Url::to($params)]);
			}
			// otherwise saving failed - database error returned
			else {
				// generate a responece to this ajax request inititiated by jquery-file_upload plugin and incorporate
				// a redirect parameter the json object for use in our fileuploadstopped callback
				$uploadHandler->generate_response($uploadHandler->response_content + ['modelerrors' => $model->getErrors()]);
			}
			return;
		}

		return $this->render('@app/views/update', [
			'model' => $model,
		]);
	}
}

?>