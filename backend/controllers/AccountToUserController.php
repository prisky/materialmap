<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
* AccountToUserController implements the CRUD actions for AccountToUser model.
*/
class AccountToUserController extends \backend\components\Controller
{

    /**
     * @inheritdoc
     */
    public $excelFormats = [
        "rate" => "0.00%",
        "newsletter" => "[=0]\"No\";[=1]\"Yes\"",
        "immediate" => "[=0]\"No\";[=1]\"Yes\""
    ];

    /**
     * @inheritdoc
     */
    public function gridColumns($searchModel) {
        return [
            [
                "attribute" => "user_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('User', []),
                "value" => function($model, $key, $index, $widget) {
                                return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "user");
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
            ],
            [
                "attribute" => "newsletter",
                "class" => "kartik\\grid\\BooleanColumn",
                "filterType" => "\\kartik\\widgets\\SwitchInput"
            ],
            [
                "attribute" => "immediate",
                "class" => "kartik\\grid\\BooleanColumn",
                "filterType" => "\\kartik\\widgets\\SwitchInput"
            ]
        ];
    }

}
