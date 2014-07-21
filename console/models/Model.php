<?php

/* 
 * Copyright Andrew Blake 2014.
 */

namespace console\models;

/**
 * @inheritdoc
 */
class Model extends \common\models\Model
{
    /**
	 * Console needs its only version here which doesn't use default scope as default scope uses some web components
     * @inheritdoc
     */
    public static function find()
    {
		$modelNameQuery = static::modelName() . 'Query';
		
		if(class_exists($modelNameQuery)) {
			$modelNameQuery = new $modelNameQuery(get_called_class());
			$modelNameQuery->attachBehavior(NULL, new \backend\components\ClosureTableQueryBehavior(get_called_class(), [
				'modelClass' => get_called_class(),
				'closureTableName' => static::closureTableName,
				'childAttribute' => static::childAttribute,
				'parentAttribute' => static::parentAttribute,
				'depthAttribute' => static::depthAttribute,
			]));

			return $modelNameQuery;
		}
    }
	
}