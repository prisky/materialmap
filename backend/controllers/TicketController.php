<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * TicketController implements the CRUD actions for Ticket model.
 */
class TicketController extends \backend\components\Controller
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
                "attribute" => "event_type_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Booking'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->booking) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->booking->label, Url::toRoute([strtolower('Booking') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->booking->label, Url::toRoute([strtolower('Booking') . "/read", "id" => $key]));
								}
								else {
									return $model->label($key);
								}
							},
                "format" => "raw"
            ],
            [
                "attribute" => "ticket_type_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('TicketType'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->ticketType) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->ticketType->label, Url::toRoute([strtolower('TicketType') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->ticketType->label, Url::toRoute([strtolower('TicketType') . "/read", "id" => $key]));
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