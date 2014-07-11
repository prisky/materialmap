<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * CancellationPolicyController implements the CRUD actions for CancellationPolicy model.
 */
class CancellationPolicyController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "base_fee" => "#.#",
        "begin" => "hh:mm AM/PM on mmmm d, yy",
        "finish" => "hh:mm AM/PM on mmmm d, yy",
        "rate" => "0.00%"
    ];

	/**
	 * @inheritdoc
	 */
	public function getGridColumns() {
		return [
            [
                "attribute" => "base_fee",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_base_fee",
                    "attribute2" => "to_base_fee"
                ]
            ],
            [
                "attribute" => "begin",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_begin",
                    "attribute2" => "to_begin"
                ],
                "filterType" => "backend\\components\\FieldRange"
            ],
            [
                "attribute" => "days"
            ],
            [
                "attribute" => "finish",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_finish",
                    "attribute2" => "to_finish"
                ],
                "filterType" => "backend\\components\\FieldRange"
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