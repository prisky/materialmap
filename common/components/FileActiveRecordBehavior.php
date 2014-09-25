<?php

namespace common\components;

use yii\base\Behavior;
use common\components\ActiveRecord;
use Yii;

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
	 * Calcualte the path component for uploads from the uploads directory for this model
	 * @return string The path
	 */
	private function getUploadsPath()
	{
		$model = $this->owner;
		
		// calculate the path from the uploads directory
		for($start = $model, $path = []; $model; $model = $model->parentModel) {
			$path[] = $model->primaryKey;
			$path[] = $model->modelNameShort;
		}

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
		// create symbolic(soft) link - cron job will remove this periodically
		exec("ln -s -f '$privatePermanentUploadsPath' '$publicTemporaryUploadsPath/{$model->primaryKey}'");
		
		// return target url
		return Yii::$app->params['webTemporaryUploadsUrl'] . "{$model->modelNameShort}/{$model->primaryKey}";
	}
			
}
