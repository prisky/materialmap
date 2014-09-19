<?php

/* 
 * Copyright Andrew Blake 2014. 
 */

namespace backend\components;

use kartik\helpers\Html;
use yii\helpers\Url;
use Yii;

class GridView extends \kartik\grid\GridView
{
	/**
	 * Generate the data item for a foreign key attribute in grid. This basically follows the signature for the closure used to set values
	 * in \kartik\grid\GridView but with the extra $foreignKeyRelationName paramter. This will create a hyper link to either read or update
	 * depending on users priveledges
	 * @param ActiveRecord $model
	 * @param string $key The primary key value of the model
	 * @param type $index
	 * @param type $widget
	 * @param string $foreignKeyRelationName the name of the relation that gets us the refereneced model
	 * @return string The html value to display in the grid
	 */
	public static function foreignKeyValue($model, $key, $index, $widget, $foreignKeyRelationName) {
		$modelNameShort = $model->modelNameShort;
		// if null foreign key
		if(!$model->$foreignKeyRelationName) {
			return;
		}
		elseif(Yii::$app->user->can($model->modelNameShort)) {
			return Html::a($model->$foreignKeyRelationName->label, Url::toRoute([strtolower("$modelNameShort/update"), "id" => $key]));
		}
		elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
			return Html::a($model->$foreignKeyRelationName->label, Url::toRoute([strtolower("$modelNameShort/read"), "id" => $key]));
		}
		else {
			return $model->label($key);
		}
	}

}