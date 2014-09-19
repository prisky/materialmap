<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * PaymentController implements the CRUD actions for Payment model.
 */
class PaymentController extends \backend\components\Controller
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
	public function gridColumns($searchModel) {
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
                "attribute" => "contact_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Contact', []),
                "value" => function($model, $key, $index, $widget) {
								return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "contact");
							},
                "format" => "raw"
            ],
            [
                "attribute" => "payment_gateway_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('PaymentGateway', []),
                "value" => function($model, $key, $index, $widget) {
								return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "paymentGateway");
							},
                "format" => "raw"
            ]
        ];
	}

}