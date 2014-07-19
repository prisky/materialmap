<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * BookingController implements the CRUD actions for Booking model.
 */
class BookingController extends \backend\components\Controller
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
                "attribute" => "status",
                "class" => "dropDownList",
                "filterWidgetOptions" => [
                    "options" => [
                        "prompt" => ""
                    ],
                    "items" => "[ 'processing' => 'Processing' 'booked' => 'Booked' 'canceled' => 'Canceled' 'wait_listed' => 'Wait listed' ]"
                ]
            ],
            [
                "attribute" => "summary_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Summary'),
                "value" => function ($model, $key, $index, $widget) {
								if(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->summary->label, Url::toRoute([strtolower('Summary') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->summary->label, Url::toRoute([strtolower('Summary') . "/read", "id" => $key]));
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