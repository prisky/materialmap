<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
* VoucherConstraintController implements the CRUD actions for VoucherConstraint model.
*/
class VoucherConstraintController extends \backend\components\Controller
{

    /**
     * @inheritdoc
     */
    public $excelFormats = [
        "invalid_from" => "hh:mm AM/PM on mmmm d, yy",
        "invalid_to" => "hh:mm AM/PM on mmmm d, yy"
    ];

    /**
     * @inheritdoc
     */
    public function gridColumns($searchModel) {
        return [
            [
                "attribute" => "invalid_from",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_invalid_from",
                    "attribute2" => "to_invalid_from",
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
                "attribute" => "invalid_to",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_invalid_to",
                    "attribute2" => "to_invalid_to",
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
