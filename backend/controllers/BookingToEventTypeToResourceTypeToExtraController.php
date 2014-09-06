<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * BookingToEventTypeToResourceTypeToExtraController implements the CRUD actions for BookingToEventTypeToResourceTypeToExtra model.
 */
class BookingToEventTypeToResourceTypeToExtraController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "amount" => "\$#,##0.00;[Red]-\$#,##0.00"
    ];

	/**
	 * @inheritdoc
	 */
	public function getGridColumns() {
		return [
            [
                "attribute" => "amount",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_amount",
                    "attribute2" => "to_amount",
                    "type" => "widget",
                    "widgetClass" => "\\kartik\\money\\MaskMoney",
                    "widgetOptions1" => [
                        "pluginOptions" => [
                            "allowEmpty" => TRUE
                        ]
                    ],
                    "widgetOptions2" => [
                        "pluginOptions" => [
                            "allowEmpty" => TRUE
                        ]
                    ]
                ]
            ],
            [
                "attribute" => "event_type_to_resource_type_to_extra_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('EventTypeToResourceTypeToExtra'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->eventTypeToResourceTypeToExtra) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->eventTypeToResourceTypeToExtra->label, Url::toRoute([strtolower('EventTypeToResourceTypeToExtra') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->eventTypeToResourceTypeToExtra->label, Url::toRoute([strtolower('EventTypeToResourceTypeToExtra') . "/read", "id" => $key]));
								}
								else {
									return $model->label($key);
								}
							},
                "format" => "raw"
            ],
            [
                "attribute" => "quantity"
            ]
        ];
	}

}