<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * MessageController implements the CRUD actions for Message model.
 */
class MessageController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "system" => "[=0]\"No\";[=1]\"Yes\""
    ];

	/**
	 * @inheritdoc
	 */
	public function getGridColumns() {
		return [
            [
                "attribute" => "email_html"
            ],
            [
                "attribute" => "email_subject"
            ],
            [
                "attribute" => "name"
            ],
            [
                "attribute" => "sms_text"
            ],
            [
                "attribute" => "system",
                "class" => "kartik\\grid\\BooleanColumn",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_system",
                    "attribute2" => "to_system"
                ]
            ]
        ];
	}

}