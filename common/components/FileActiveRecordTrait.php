<?php

namespace common\components;

use Yii;
use yii\web\UploadedFile;
use common\components\File;

/**
 * FileActiveRecordTrait adds file upload functionality to an ActiveRecord. To be used in conjuction with FileControllerTrait and
 * dosamigos\fileupload\FileUploadUI, a Yii2 Widget encapsulating http://blueimp.github.io/jQuery-File-Upload/
 *
 * @author Andrew Blake <admin@newzealandfishing.com>
 */
trait FileActiveRecordTrait
{
	public $files;

	/**
	 * @inheritdoc. Unobtrusively clean out any uploaded files related to a model deleted from the database. Ideally
	 * a database trigger would do this but not possible in MYSQL hence this is the best we can do. Event firing after delete
	 * similar to an after delete trigger
	 * @param type $event
	 */
	public function afterDelete()
    {
		// remove any uploads if exist
//		exec("rm -rf " . Yii::$app->params['privatePermanentUploadsPath'] . $this->uploadsPath");
    }


	/**
	 * Calcualte the path component for uploads
	 * @return string The path
	 */
	public function getPath()
	{
		static $path = [];

		// cache
		if(isset($path[$this->id])) {
			return $path[$this->id];
		}

		// calculate the path from the uploads directory
		for($model = $this, $path = []; $model; $model = $model->parentModel) {
			if($model->primaryKey) {
				$path[] = $model->primaryKey;
			}
			$path[] = $model->modelNameShort;
		}

		return $path[$this->id] = implode('/', array_reverse($path));
	}
	
	/**
	 * Load file info array into a model attribute, containing potentially existing loaded files, new files, and perhaps ignore some
	 * @param string $attribute the model attribute to load files into
	 * @param array $delete a list of files to ignore for this attribute i.e. don't load existing info for
	 */
	public function loadFileAttribute($attribute, $ignore = []) {
		// get the attributes path on storage of if attribute is files then files are against whole model
		$path = $this->path;
		if($attribute != 'files') {
			$path .= '/' . $attribute;
		}
		
		// get existing from storage - just the names and details but not the files
		$files = Yii::$app->resourceManager->listFiles($path . '/' . File::LARGE_IMAGE . '/');
		
		// handle posted deletes
		foreach($files as $key => $file) {
			// if file is requested to be deleted
			if(in_array($file['name'], $ignore)) {
				// remove from our files array
				unset($files[$key]);
			}
		}

		$this->$attribute = array_merge($files, UploadedFile::getInstancesByName($attribute));
	}

	/**
	 * Load file info array into a model attributes, containing potentially existing loaded files, new files, and perhaps ignore some
	 * @param array $delete a list of files to ignore i.e. don't load existing info for
	 */
	public function loadFileAttributes($ignore = []) {
		foreach($this->fileAttributes as $attribute) {
			$this->loadFileAttribute($attribute, isset($ignore[$attribute]) ?$ignore[$attribute] : []);
		}
	}

}
?>
