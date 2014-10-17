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
        "town_city_id" => "#"
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
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_town_city_id",
                    "attribute2" => "to_town_city_id"
                ]
            ],
            [
                "attribute" => "post_code"
            ],
            [
                "attribute" => "address_line1"
            ],
            [
                "attribute" => "address_line2"
            ]
        ];
    }

}
