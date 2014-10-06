<?php

namespace common\components;

use yii\base\Behavior;
use common\components\ActiveRecord;
use Yii;
use yii\web\UploadedFile;
use common\components\File;

/**
 * @inheritdoc
 *
 * @author Andrew Blake <admin@newzealandfishing.com>
 */
class FileActiveRecordBehavior extends Behavior
{
    /**
     * @var array of UploadedFile relative to the model as opposed to an attribute
     */
	public $files = [];

	public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
      ];
    }

	/**
	 * @inheritdoc. Unobtrusively clean out any uploaded files related to a model deleted from the database. Ideally
	 * a database trigger would do this but not possible in MYSQL hence this is the best we can do. Event firing after delete
	 * similar to an after delete trigger
	 * @param type $event
	 */
	public function afterDelete($event)
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
		static $path;

		// cache
		if($path) {
			return $path;
		}

		$model = $this->owner;
		
		// calculate the path from the uploads directory
		for($start = $model, $path = []; $model; $model = $model->parentModel) {
			$path[] = $model->primaryKey;
			$path[] = $model->modelNameShort;
		}

		return $path = implode('/', array_reverse($path));
	}
	
	/**
	 * Load file info array into a model attribute, containing potentially existing loaded files, new files, and perhaps ignore some
	 * @param string $attribute the model attribute to load files into
	 * @param bool $loadExisting whether to load existing files from storage first
	 * @param array $delete a list of files to ignore for this attribute i.e. don't load existing info for
	 */
	public function loadFileAttribute($attribute, $loadExisting = false, $ignore = []) {
		$model = $this->owner;
		// get the attributes path on storage of if attribute is files then files are against whole model
		$path = $model->path;
		if($attribute != 'files') {
			$path .= '/' . $attribute;
		}
		
		// get existing from storage - just the names and details but not the files
		$files = $loadExisting
			? Yii::$app->resourceManager->listFiles($path . '/' . File::LARGE_IMAGE . '/')
			: [];
		
		// handle posted deletes
		foreach($files as $key => $file) {
			// if file is requested to be deleted
			if(in_array($file['name'], $ignore)) {
				// remove from our files array
				unset($files[$key]);
			}
		}

		$model->$attribute = array_merge($files, UploadedFile::getInstancesByName($attribute));
	}

	/**
	 * Load file info array into a model attributes, containing potentially existing loaded files, new files, and perhaps ignore some
	 * @param bool $loadExisting whether to load existing files from storage first
	 * @param array $delete a list of files to ignore i.e. don't load existing info for
	 */
	public function loadFileAttributes($loadExisting = false, $ignore = []) {
		$model = $this->owner;
		foreach($model->fileAttributes as $attribute) {
			$this->loadFileAttribute($attribute, $loadExisting, isset($ignore[$attribute]) ?$ignore[$attribute] : []);
		}
	}

}
?>
