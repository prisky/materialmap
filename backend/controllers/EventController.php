<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "end" => "hh:mm AM/PM on mmmm d, yy",
        "start" => "hh:mm AM/PM on mmmm d, yy"
    ];

	/**
	 * @inheritdoc
	 */
	public function getGridColumns() {
		return [
            [
                "attribute" => "end",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_end",
                    "attribute2" => "to_end"
                ],
                "filterType" => "backend\\components\\FieldRange"
            ],
            [
                "attribute" => "event_detail_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('EventDetail'),
                "value" => function ($model, $key, $index, $widget) {
								if(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->eventDetail->label, Url::toRoute([strtolower('EventDetail') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->eventDetail->label, Url::toRoute([strtolower('EventDetail') . "/read", "id" => $key]));
								}
								else {
									return $model->label($key);
								}
							},
                "format" => "raw"
            ],
            [
                "attribute" => "start",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_start",
                    "attribute2" => "to_start"
                ],
                "filterType" => "backend\\components\\FieldRange"
            ],
            [
                "attribute" => "status",
                "class" => "dropDownList",
                "filterWidgetOptions" => [
                    "options" => [
                        "prompt" => ""
                    ],
                    "items" => "[ 'confirmed' => 'Confirmed' 'canceled' => 'Canceled' 'awaiting_mimimum' => 'Awaiting mimimum' ]"
                ]
            ]
        ];
	}

}