<?php

namespace common\components;

use Yii;
use yii\helpers\Url;
use common\models\Model;
use kartik\helpers\Html;
use yii\web\UploadedFile;
use yii\web\Response;
use common\components\File;

/**
 * FileControllerTrait adds file upload functionality to a controller. To be used in conjuction with FileActiveRecordBehavior and
 * dosamigos\fileupload\FileUploadUI, a Yii2 Widget encapsulating http://blueimp.github.io/jQuery-File-Upload/
 *
 * @author Andrew Blake <admin@newzealandfishing.com>
 */
trait FileControllerTrait
{

	public function actionGetexistingfiles($id, $attribute = null)
	{
		$inputName = $attribute ? $attribute : 'files';
		$response = [];
		$model = $this->findModel($id);
		$path = $attribute ? $model->path . '/' . $attribute : $model->path;
		$manager = Yii::$app->resourceManager;
		$privacy = File::ISPUBLIC;

		// get list of existing files from storage
		foreach($manager->listFiles($path . '/' . File::LARGE_IMAGE . '/') as $file) {
			$response[$inputName . '[]'][] = [
				'name' => $file['name'],
				'type' => $file['type'],
				'size' => $file['size'],
				'url' => $manager->getUrl($file['path'], $privacy),
				'thumbnailUrl' => $manager->getUrl($path . '/' . File::SMALL_IMAGE . '/' . $file['name'], $privacy),
				// not actually url to delete but the file itself - easiest hack
				'deleteUrl' => $file['name'],
				'deleteType' => 'POST'
			];
		}

		Yii::$app->response->getHeaders()->set('Vary', 'Accept');
		Yii::$app->response->format = Response::FORMAT_JSON;

		return $response;
	}
	
	/**
	 * When generating the response for jquery-file-upload, need to be careful to return a similarly indexed array as this is what jquery file
	 * upload expects.
	 * @param ActiveRecord $model
	 * @param array $deleteFiles in form [attribute => pathName]
	 * @param bool $save true if good to save changes
	 */
	private function filesResponse($model, $deleteFiles, $save)
	{
		$response = [];

		foreach($model->fileAttributes as $attribute) {
			foreach($model->$attribute as $uploadedFile) {
				// the files array may contain existing uploads which will be arrays rather than UploadedFile's
				if(!$uploadedFile instanceof UploadedFile) {
					// skip existing
					continue;
				}
	
				$file = new File(['file' => $uploadedFile, 'basePath' => $model->path]);
				// validate this individual file
				$file->validate();
				// build response
				$response[$attribute . '[]'][] = $file->jqueryFileUploadResponse();

				// remove temporary file
				@unlink($file->file->tempName);
	
				if($save) {
					$file->save();
				}
			}
			
			// deletes
			$manager = Yii::$app->resourceManager;
			$path = $model->path;
			foreach($deleteFiles as $attribute => $name) {
				// if saving
				if($save) {
					$file = new File(['name' => $name, 'basePath', ($attribute == 'files') ? $path : $path . '/' . $attribute]);
					// remove from storage
	//				$file->delete();
					// response not important as redirect will occurr when saving
				} else {	// response is important as not redirecting
					// did validation fail for this attribute
					if($model->getErrors($attribute)) {
						// did validataion fail possibly because of a mandatory requirement
						foreach($model->getActiveValidators($attribute) as $validator) {
							// if required validator
							if($validator instanceof \yii\validators\RequiredValidator) {
								// if we have no files left
								if(empty($model->$attribute)) {
									// indicate response to restore it
									$response['restore'][$attribute] = $name;
								}
							}
						}
					}
				}
			}
		}
		
		return $response;
	}

	public function actionSave($id = null)
	{
		$response = [];
	
		$save = true;
		$model = $this->findModel($id);
		$model->load(Yii::$app->request->post());
		$deleteFiles = isset($_POST['delete']) ? $_POST['delete'] : [];
		$model->loadFileAttributes(true, $deleteFiles);

		// allow rollback if any error occurrs with saving form data or file upload
		$transaction = Yii::$app->db->beginTransaction();
		if($save = $model->save()) {
			// set redirect back to parent index view
			$params[] = 'index';
			$fullModelName = $this->modelName;
			if($parentAttribute = $fullModelName::parentAttribute()) {
				$params[$parentAttribute] = $model->$parentAttribute;
			}
//			$response += ['redirect' => Url::to($params)];
			$transaction->commit();
		}
		else {
			$transaction->rollback();
		}

		// save errors is property added to ActiveRecord to hold errors caught from attempting to save to database inside transaction that got
		// past normal validation. These errors will only occurr on a a delete, insert or update of database and are potentially trigger related
		// e.g. validating that an adjacency list doesn't create endless loop (force a trigger error and detect here)
		if($model->saveErrors) {
			// send these thru but format the html here - an error block above form
			$response['nonattributeerrors'] = 
				Html::listGroup($model->saveErrors, ['class' => 'list-group'], 'ul', 'li class="list-group-item list-group-item-danger"');
		}

		// add form errors for blueimp fileuploadfinished callback - borrowed from \yii\widgets\ActiveForm::validate()
		foreach ($model->getErrors() as $attribute => $errors) {
			$response['activeformerrors'][Html::getInputId($model, $attribute)] = $errors;
		}
		
		// get the files response - validattion errors in model
		$response = array_merge($response, $this->filesResponse($model, $deleteFiles, $save));

		Yii::$app->response->getHeaders()->set('Vary', 'Accept');
		Yii::$app->response->format = Response::FORMAT_JSON;

		return $response;
	}
	
}

?>