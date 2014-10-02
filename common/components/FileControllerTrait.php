<?php

namespace common\components;

use Yii;
use dosamigos\fileupload\UploadHandler;
use yii\helpers\Url;
use common\models\Model;
use kartik\helpers\Html;

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
	private function initUploadHandler($model, $options = [])
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
		$modelName = $this->modelName;
		$uploadHandlerOptions = ['param_name' => 'files[]'];
		
		// the UploadHandler from blueImp will take care of this type
		// of delete which is just a file delete and not a delete of our ActiveRecord model hence don't want to hand of to action delete
		// but just let UploadHandler do its work removing any identifying files
		// Alternately if get request then probably wanting something like a list of files as a JSON object
		if((isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') || Yii::$app->request->isGet) {
			// if deleteing - as opposed to getting list of files on when creating in which case no id so can't do it
			if($id) {
				$this->initUploadHandler($modelName::findOne($id), $uploadHandlerOptions);
			}
        }
		// otherwise a post request - update or create action
		else {
			// will want to roll back database changes if a file upload error occurrs. Save is already in a transaction and appends
			// any database errors against to model (not indexed by attribute)
			$transaction = Yii::$app->db->beginTransaction();

			// if updating - id passed
			if($id) {
				$model = $this->findModel($id);
				$model->load(Yii::$app->request->post());
				// handle files uploads and buffer the response
				$uploadHandler = $this->initUploadHandler($model, $uploadHandlerOptions + ['print_response' => false]);
				// add response from blueimps upload handler - key is 'files'
				$response = $uploadHandler->response_content;
				// if no validation errors - or other database errors when saving
				if($model->save()) {
					// if no upload errors
					if(!$uploadHandler->has_errors) {
						// set redirect back to parent index view
						$params[] = 'index';
						$fullModelName = $this->modelName;
						if($parentAttribute = $fullModelName::parentAttribute()) {
							$params[$parentAttribute] = $model->$parentAttribute;
						}
						// add a 'redirect' key for our blueimp fileuploadfinished callback
						$response += ['redirect' => Url::to($params)];
					}
				}

				// if errors
				if(!isset($response['redirect'])) {
					$privatePermanentUploadsPath = Yii::$app->params['privatePermanentUploadsPath'] . $model->uploadsPath;
					// remove the files from where they were moved to
					foreach($uploadHandler->response_content[$uploadHandlerOptions['param_name']] as $file) {
						unlink($privatePermanentUploadsPath . '/' . $file->name);
						unlink($privatePermanentUploadsPath . '/thumbnail/' . $file->name);
					}
				}
			}
			// otherwise creating -- no id
			else {
				$response = [];
				$model = $this->newModelWithDefaults;
				$model->load(Yii::$app->request->get());	// need to tidy up so all paramters in post
				$model->load(Yii::$app->request->post());
				// if no validation errors - or other database errors when saving
				if($model->save()) {
					// handle files and buffer the response
					$uploadHandler = $this->initUploadHandler($model, $uploadHandlerOptions + ['print_response' => false]);
					// initiaize response to the files array with upload results from blueimps upload handler
					$response = $uploadHandler->response_content;
					// if no upload errors
					if(!$uploadHandler->has_errors) {
						// if this model is leaf node in navigation
						if(Model::findOne(['auth_item_name' => $this->modelNameShort])->isLeaf()) {
							// go to the admin view of this node
							$params[] = 'index';
							$fullModelName = $this->modelName;
							if($parentAttribute = $fullModelName::parentAttribute()) {
								$params[$parentAttribute] = $model->$parentAttribute;
							}
						}
						else {
							// go to the update view
							$params = ['update', 'id' => $model->id];
						}
						// add a 'redirect' key for our blueimp fileuploadfinished callback
						$response += ['redirect' => Url::to($params)];
					}
				}

				// if errors and we did deal with file uploads
				if(!isset($response['redirect']) && isset($response['files'])) {
					$privatePermanentUploadsPath = Yii::$app->params['privatePermanentUploadsPath'] . $model->uploadsPath;
					// remove upload directory
					unlink($privatePermanentUploadsPath);
				}
			}

			// if there is errors but not specific attribute errors - may be trigger related
			if($this->model->saveErrors) {
				// send these thru but format the html here - an error block above form
				$response['nonattributeerrors'] = 
					Html::listGroup($this->model->saveErrors, ['class' => 'list-group'], 'ul', 'li class="list-group-item list-group-item-danger"');
			}

			// add form errors for blueimp fileuploadfinished callback - to handle with yiiActiveForm
			$response += ['activeformerrors' => \yii\widgets\ActiveForm::validate($model)];
			// NB:at this stage we may still not have no files array as if ActiveRecord:save failed then we didn't handle uploads
			// this scenario dealt with in client handler fileuploaddone by assuming upload was ok.

			// save database chanes if no errors or revert if errors
			isset($response['redirect']) ? $transaction->commit() : $transaction->rollBack();

			/* TODO: assuming json respose but may need to be plain text
// https://github.com/blueimp/jQuery-File-Upload/wiki/Setup#using-jquery-file-upload-ui-version-with-a-custom-server-side-upload-handler
header('Vary: Accept');
if (isset($_SERVER['HTTP_ACCEPT']) &&
    (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
    header('Content-type: application/json');
} else {
    header('Content-type: text/plain');
}*/
			// send json response
			Yii::$app->response->format = 'json';
			return $response;
        }
	}
}

?>