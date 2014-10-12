<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * ContactController implements the CRUD actions for Contact model.
 */
class ContactController extends \backend\components\Controller
{

	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "verified" => "hh:mm AM/PM on mmmm d, yy"
    ];

	/**
	 * @inheritdoc
	 */
	public function gridColumns($searchModel) {
		return [
            [
                "attribute" => "first_name"
            ],
            [
                "attribute" => "last_name"
            ],
            [
                "attribute" => "email"
            ],
            [
                "attribute" => "phone_mobile"
            ],
            [
                "attribute" => "town_city_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('TownCity', []),
                "value" => function($model, $key, $index, $widget) {
								return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "townCity");
							},
                "format" => "raw"
            ],
            [
                "attribute" => "post_code"
            ],
            [
                "attribute" => "address_line1"
            ],
            [
                "attribute" => "address_line2"
            ],
            [
                "attribute" => "verified",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_verified",
                    "attribute2" => "to_verified",
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