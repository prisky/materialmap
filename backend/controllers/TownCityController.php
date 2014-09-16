<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * TownCityController implements the CRUD actions for TownCity model.
 */
class TownCityController extends \backend\components\Controller
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
                "attribute" => "name"
            ],
            [
                "attribute" => "state_province_region",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('StateProvinceRegion'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->stateProvinceRegion) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->stateProvinceRegion->label, Url::toRoute([strtolower('StateProvinceRegion') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->stateProvinceRegion->label, Url::toRoute([strtolower('StateProvinceRegion') . "/read", "id" => $key]));
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