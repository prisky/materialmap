<?php

namespace common\components;

use Yii;

/**
 * FileControllerTrait adds file upload functionality to a controller. To be used in conjuction with FileActiveRecordBehavior and
 * dosamigos\fileupload\FileUploadUI, a Yii2 Widget encapsulating http://blueimp.github.io/jQuery-File-Upload/
 *
 * @author Andrew Blake <admin@newzealandfishing.com>
 */
trait FileControllerTrait {

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
			$modelName::findOne($id)->initUploadHandler();
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

}

?>