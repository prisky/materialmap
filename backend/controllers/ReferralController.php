<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * ReferralController implements the CRUD actions for Referral model.
 */
class ReferralController extends \backend\components\Controller
{

	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "rate" => "0.00%"
    ];

	/**
	 * @inheritdoc
	 */
	public function gridColumns($searchModel) {
		return [
            [
                "attribute" => "summary_to_account_to_user_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('SummaryToAccountToUser', ['user_id' => $searchModel->first_referrer_user_id]),
                "value" => function($model, $key, $index, $widget) {
								return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "summaryToAccountToUser");
							},
                "format" => "raw"
            ],
            [
                "attribute" => "account_to_user_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('AccountToUser', ['account_id' => $searchModel->account_id]),
                "value" => function($model, $key, $index, $widget) {
								return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "accountToUser");
							},
                "format" => "raw"
            ],
            [
                "attribute" => "invoice_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Invoice', ['account_to_user_id' => $searchModel->account_to_user_id]),
                "value" => function($model, $key, $index, $widget) {
								return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "invoice");
							},
                "format" => "raw"
            ],
            [
                "attribute" => "rate",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_rate",
                    "attribute2" => "to_rate",
                    "type" => "\\kartik\\widgets\\TouchSpin",
                    "widgetOptions1" => [
                        "pluginOptions" => [
                            "verticalbuttons" => TRUE,
                            "verticalupclass" => "glyphicon glyphicon-plus",
                            "verticaldownclass" => "glyphicon glyphicon-minus"
                        ]
                    ],
                    "widgetOptions2" => [
                        "pluginOptions" => [
                            "verticalbuttons" => TRUE,
                            "verticalupclass" => "glyphicon glyphicon-plus",
                            "verticaldownclass" => "glyphicon glyphicon-minus"
                        ]
                    ]
                ]
            ]
        ];
	}

}