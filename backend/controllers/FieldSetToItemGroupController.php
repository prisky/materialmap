<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * FieldSetToItemGroupController implements the CRUD actions for FieldSetToItemGroup model.
 */
class FieldSetToItemGroupController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [

    ];

	/**
	 * @inheritdoc
	 */
	public function getGridColumns() {
		return [
            [
                "attribute" => "item_group_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('ItemGroup'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->itemGroup) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->itemGroup->label, Url::toRoute([strtolower('ItemGroup') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->itemGroup->label, Url::toRoute([strtolower('ItemGroup') . "/read", "id" => $key]));
								}
								else {
									return $model->label($key);
								}
							},
                "format" => "raw"
            ]
        ];
	}

}