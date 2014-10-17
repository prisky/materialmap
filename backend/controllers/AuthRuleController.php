<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
* AuthRuleController implements the CRUD actions for AuthRule model.
*/
class AuthRuleController extends \backend\components\Controller
{

    /**
     * @inheritdoc
     */
    public $excelFormats = [
        "created_at" => "#",
        "updated_at" => "#"
    ];

    /**
     * @inheritdoc
     */
    public function gridColumns($searchModel) {
        return [
            [
                "attribute" => "data"
            ],
            [
                "attribute" => "created_at",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_created_at",
                    "attribute2" => "to_created_at"
                ]
            ],
            [
                "attribute" => "updated_at",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_updated_at",
                    "attribute2" => "to_updated_at"
                ]
            ]
        ];
    }

}
