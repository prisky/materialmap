<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * CouponController implements the CRUD actions for Coupon model.
 */
class CouponController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "expiry" => "hh:mm AM/PM on mmmm d, yy"
    ];

	/**
	 * @inheritdoc
	 */
	public function gridColumns($searchModel) {
		return [
            [
                "attribute" => "expiry",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_expiry",
                    "attribute2" => "to_expiry",
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
                "attribute" => "reseller_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Reseller', ['account_id' => $searchModel->account_id]),
                "value" => function($model, $key, $index, $widget) {
								return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "reseller");
							},
                "format" => "raw"
            ],
            [
                "attribute" => "uniqueid"
            ]
        ];
	}

}