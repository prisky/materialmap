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
	public function getGridColumns() {
		return [
            [
                "attribute" => "address_line1"
            ],
            [
                "attribute" => "address_line2"
            ],
            [
                "attribute" => "email"
            ],
            [
                "attribute" => "first_name"
            ],
            [
                "attribute" => "last_name"
            ],
            [
                "attribute" => "phone_mobile"
            ],
            [
                "attribute" => "post_code"
            ],
            [
                "attribute" => "town_city_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('TownCity'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->townCity) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->townCity->label, Url::toRoute([strtolower('TownCity') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->townCity->label, Url::toRoute([strtolower('TownCity') . "/read", "id" => $key]));
								}
								else {
									return $model->label($key);
								}
							},
                "format" => "raw"
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