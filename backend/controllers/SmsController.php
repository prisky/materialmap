<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * SmsController implements the CRUD actions for Sms model.
 */
class SmsController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "outgoing" => "[=0]\"No\";[=1]\"Yes\""
    ];

	/**
	 * @inheritdoc
	 */
	public function gridColumns($searchModel) {
		return [
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
                "attribute" => "outgoing",
                "class" => "kartik\\grid\\BooleanColumn",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_outgoing",
                    "attribute2" => "to_outgoing"
                ]
            ],
            [
                "attribute" => "sms_message"
            ]
        ];
	}

}