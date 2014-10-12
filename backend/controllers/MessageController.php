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
    public function gridColumns($searchModel) {
        return [
            [
                "attribute" => "name"
            ],
            [
                "attribute" => "system",
                "class" => "kartik\\grid\\BooleanColumn",
                "filterType" => "\\kartik\\widgets\\SwitchInput"
            ],
            [
                "attribute" => "email_html"
            ],
            [
                "attribute" => "email_subject"
            ],
            [
                "attribute" => "sms_text"
            ]
        ];
    }

}
