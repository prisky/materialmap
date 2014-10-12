<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
* BidController implements the CRUD actions for Bid model.
*/
class BidController extends \backend\components\Controller
{

    /**
     * @inheritdoc
     */
    public $excelFormats = [
        "offer" => "#.#",
        "deadline" => "hh:mm AM/PM on mmmm d, yy",
        "updated" => "hh:mm AM/PM on mmmm d, yy"
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
                "attribute" => "question_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Question', ['account_id' => $searchModel->account_id]),
                "value" => function($model, $key, $index, $widget) {
                                return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "question");
                            },
                "format" => "raw"
            ],
            [
                "attribute" => "offer",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_offer",
                    "attribute2" => "to_offer"
                ]
            ],
            [
                "attribute" => "comment_markdown"
            ],
            [
                "attribute" => "deadline",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_deadline",
                    "attribute2" => "to_deadline",
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
                "attribute" => "updated",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_updated",
                    "attribute2" => "to_updated",
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
