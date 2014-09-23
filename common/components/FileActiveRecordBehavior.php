<?php

namespace common\components;

use yii\base\Behavior;
use common\components\ActiveRecord;
use common\models\Model;

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
			ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
			ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
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
		// directory path to this model
		$path = Model::find()
			->select(['auth_item_name'])
			->pathOf(Model::findOne(['auth_item_name' => $event->sender->modelNameShort])->id)
			->asArray()
			->all();
		$path = implode('/', $path);
		
		// remove any uploads if exist
//		exec("rm -rf " . Yii::$app->params['privatePermanentUploadsPath'] . "/$path/{$event->sender->id}");
    }

	public function beforeInsert($event)
    {
		$this->expose($event->sender->expose());
    }

	public function afterInsert($event)
    {
		$this->initUploadHandler($event->sender->id);
    }
	
	public function beforeUpdate($event)
    {
		$this->expose($event->sender->expose());
    }

	public function afterUpdate($event)
    {
		$this->initUploadHandler($event->sender->id);
    }
	
	public function expose()
	{
		$model = $this->owner;
		
		// create a symlink in below doc root to expose to web
		$source = Yii::app()->params['privateUploadPath'] . "$modelDir/{$this->owner->id}/"; 
		// target directory
		$target = Yii::app()->params['publicUploadPath'] . "$modelDir/{$this->id}";
		// create the symlink
		exec("ln -s -f $source $target");
		
		// return target url
		return Yii::app()->params['webUploadPath'] . "$modelDir/$session_id{$this->id}/";
	}	
			
}

