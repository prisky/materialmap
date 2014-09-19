<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * InvoiceController implements the CRUD actions for Invoice model.
 */
class InvoiceController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "invoiced" => "hh:mm AM/PM on mmmm d, yy",
        "paid" => "hh:mm AM/PM on mmmm d, yy"
    ];

	/**
	 * @inheritdoc
	 */
	public function gridColumns($searchModel) {
		return [
            [
                "attribute" => "account_to_user_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('AccountToUser', []),
                "value" => function($model, $key, $index, $widget) {
								return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "accountToUser");
							},
                "format" => "raw"
            ],
            [
                "attribute" => "invoiced",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_invoiced",
                    "attribute2" => "to_invoiced",
                    "type" => "\\kartik\\widgets\\DateTimePicker",
                    "widgetOptions1" => [
                        "type" => 1,
                        "pluginOptions" => [
                            "autoclose" => TRUE
                        ]
                    ],
                    "widgetOptions2" => [
                        "type" => 1,
                        "pluginOptions" => [
                            "autoclose" => TRUE
                        ]
                    ]
                ]
            ],
            [
                "attribute" => "paid",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_paid",
                    "attribute2" => "to_paid",
                    "type" => "\\kartik\\widgets\\DateTimePicker",
                    "widgetOptions1" => [
                        "type" => 1,
                        "pluginOptions" => [
                            "autoclose" => TRUE
                        ]
                    ],
                    "widgetOptions2" => [
                        "type" => 1,
                        "pluginOptions" => [
                            "autoclose" => TRUE
                        ]
                    ]
                ]
            ]
        ];
	}

}