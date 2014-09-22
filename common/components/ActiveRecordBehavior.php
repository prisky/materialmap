<?php

namespace app\components;

use yii\base\Behavior;
use common\components\ActiveRecord;
use common\models\Model;

/**
 * @inheritdoc
 *
 * @author Andrew Blake <admin@newzealandfishing.com>
 */
class ActiveRecordBehavior extends Behavior
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
		// directory path to this model
		$path = Model::find()
			->select(['auth_item_name'])
			->pathOf(Model::findOne(['auth_item_name' => $event->sender->modelNameShort])->id)
			->asArray()
			->all();
		$path = implode('/', $path);
		
		// remove any uploads if exist
		$publicPermanentUploadsPath = Yii::$app->params['publicPermanentUploadsPath'] . "/{$event->sender->id}";
		exec("rm -rf $publicPermanentUploadsPath");
		$privatePermanentUploadsPath = Yii::$app->params['privatePermanentUploadsPath'] . "/{$event->sender->id}";
		exec("rm -rf $publicPermanentUploadsPath");
    }

}

