<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * AccountToMessageController implements the CRUD actions for AccountToMessage model.
 */
class AccountToMessageController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [

    ];

	/**
	 * @inheritdoc
	 */
	public function gridColumns($searchModel) {
		return [
            [
                "attribute" => "email_message"
            ],
            [
                "attribute" => "email_subject"
            ],
            [
                "attribute" => "message_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Message', []),
                "value" => function($model, $key, $index, $widget) {
								return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "message");
							},
                "format" => "raw"
            ],
            [
                "attribute" => "sms_message"
            ]
        ];
	}

}