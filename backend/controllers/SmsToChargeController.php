<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * SmsToChargeController implements the CRUD actions for SmsToCharge model.
 */
class SmsToChargeController extends \backend\components\Controller
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
                "attribute" => "charge_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Charge'),
                "value" => function ($model, $key, $index, $widget) {
								if(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->charge->label, Url::toRoute([strtolower('Charge') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->charge->label, Url::toRoute([strtolower('Charge') . "/read", "id" => $key]));
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