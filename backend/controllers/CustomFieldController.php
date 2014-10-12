<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
* CustomFieldController implements the CRUD actions for CustomField model.
*/
class CustomFieldController extends \backend\components\Controller
{

    /**
     * @inheritdoc
     */
    public $excelFormats = [
        "allow_new" => "[=0]\"No\";[=1]\"Yes\"",
        "mandatory" => "[=0]\"No\";[=1]\"Yes\""
    ];

    /**
     * @inheritdoc
     */
    public function gridColumns($searchModel) {
        return [
            [
                "attribute" => "account_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Account', []),
                "value" => function($model, $key, $index, $widget) {
                                return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "account");
                            },
                "format" => "raw"
            ],
            [
                "attribute" => "label"
            ],
            [
                "attribute" => "allow_new",
                "class" => "kartik\\grid\\BooleanColumn",
                "filterType" => "\\kartik\\widgets\\SwitchInput"
            ],
            [
                "attribute" => "validation_type",
                "filter" => [
                    "None" => "None",
                    "PCRE" => "PCRE",
                    "Range" => "Range",
                    "Value list" => "Value list"
                ]
            ],
            [
                "attribute" => "data_type",
                "filter" => [
                    "None" => "None",
                    "PCRE" => "PCRE",
                    "Range" => "Range",
                    "Value list" => "Value list",
                    "Date" => "Date",
                    "Float" => "Float",
                    "Int" => "Int",
                    "Text" => "Text",
                    "Time" => "Time"
                ]
            ],
            [
                "attribute" => "mandatory",
                "class" => "kartik\\grid\\BooleanColumn",
                "filterType" => "\\kartik\\widgets\\SwitchInput"
            ],
            [
                "attribute" => "comment"
            ],
            [
                "attribute" => "validation_text"
            ],
            [
                "attribute" => "validation_error"
            ]
        ];
    }

}
