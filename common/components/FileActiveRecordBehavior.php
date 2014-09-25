<?php

namespace common\components;

use yii\base\Behavior;
use common\components\ActiveRecord;
use common\models\Model;
use Yii;
use dosamigos\fileupload\UploadHandler;
use yii\helpers\Url;

/**
 * @inheritdoc
 *
 * @author Andrew Blake <admin@newzealandfishing.com>
 */
class FileActiveRecordBehavior extends Behavior
{
	public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
  			ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
			ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
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
	 * @inherit Check that the upload occurrs fine. If error then make sure Insert doesn't occur and do cleanup i.e. removing any directories
	 * created
	 * @param Event $event
	 */
	public function beforeInsert($event)
    {
		// if any errors then then will be an output otherwise we hide the output
		if($this->initUploadHandler()) {
			// stop submission - response allready outputted
			$event->isValid = false;
			// remove any files downloaded
		}
    }
	
	/**
	 * @inherit Check that the upload occurrs fine. If error then make sure update doesn't occur and do cleanup i.e. removing any directories
	 * created
	 * @param ModelEvent::isValid $event
	 */
	public function beforeUpdate($event)
    {
		// if any errors then then will be an output otherwise we hide the output
		if($this->initUploadHandler()) {
			// stop submission - response allready outputted
			$event->isValid = false;
			// remove any files downloaded
		}
    }

	/**
	 * Calcualte the path component for uploads from the uploads directory for this model
	 * @return string The path
	 */
	public function getUploadsPath()
	{
		$model = $this->owner;
		
		// calculate the path from the uploads directory
		for($start = $model, $path = []; $model; $model = $model->parentModel) {
			$path[] = $model->primaryKey;
			$path[] = $model->modelNameShort;
		}

		$t = array_reverse($path);
		$t = implode(',', array_reverse($path));
		return implode('/', array_reverse($path));
	}

	/**
	 * Soft link a directory associated to a model from outside the document to inside the document root in order to make it publicly available
	 * over the internet. This will be cleaned up depending on the age of the link hence the reason for soft link over hard link. The source
	 * directory structure follows our navigation hierachy architecuture but the destination is just single 
	 * @return string The directory url that has been temporarily published/exposed to the web
	 */
	public function publish()
	{
		$model = $this->owner;

		// ensure source directory exists
		$path = $model->uploadsPath;
		$privatePermanentUploadsPath = Yii::$app->params['privatePermanentUploadsPath'] . $path;
		$publicTemporaryUploadsPath = Yii::$app->params['publicTemporaryUploadsPath'] . $model->modelNameShort;
		exec("mkdir -p '$privatePermanentUploadsPath'");
		// ensure target base directory exists
		exec("mkdir -p '$publicTemporaryUploadsPath'");
$t1= "ln -s -f '$privatePermanentUploadsPath' '$publicTemporaryUploadsPath/{$model->primaryKey}'";
		// create symbolic(soft) link - cron job will remove this periodically
		exec("ln -s -f '$privatePermanentUploadsPath' '$publicTemporaryUploadsPath/{$model->primaryKey}'");
		
		// return target url
$t2 = Yii::$app->params['webTemporaryUploadsUrl'] . "{$model->modelNameShort}/{$model->primaryKey}";
		return Yii::$app->params['webTemporaryUploadsUrl'] . "{$model->modelNameShort}/{$model->primaryKey}";
	}
	
	/**
	 * Initialize the upload handler provided by http://blueimp.github.io/jQuery-File-Upload/. This will ensure the existance of our
	 * destination uploads directory
	 * @param ActiveRecord $model The model
	 */
	public function initUploadHandler()
	{
		$model = $this->owner;

		// ensure destination directory exists - this will mean that if an ancestor gets deleted then everything below will too
		$path = $model->uploadsPath;
		$privatePermanentUploadsPath = Yii::$app->params['privatePermanentUploadsPath'] . $path;
		exec("mkdir -p $privatePermanentUploadsPath");

		// initialize the upload handler
		new UploadHandler(array(
			'upload_dir' => $privatePermanentUploadsPath . '/',
			'upload_url' => $model->publish() . '/',
			'script_url' => Url::to(['upload', 'id'=>$model->primaryKey]),
			'delete_type' => 'POST',
			'image_versions'=>array('thumbnail'=>array(
				'upload_url' => $model->publish() . "/thumbnail/",
				'max_width' => '80px',
				'max_height' => '80px',
			))
 		));
	}
			
}
