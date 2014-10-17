<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
* MapSettingController implements the CRUD actions for MapSetting model.
*/
class MapSettingController extends \backend\components\Controller
{

    /**
     * @inheritdoc
     */
    public $excelFormats = [
        "zoom_level" => "#"
    ];

    /**
     * @inheritdoc
     */
    public function gridColumns($searchModel) {
        return [
            [
                "attribute" => "zoom_level",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_zoom_level",
                    "attribute2" => "to_zoom_level"
                ]
            ],
            [
                "attribute" => "latitude"
            ],
            [
                "attribute" => "longitude"
            ]
        ];
    }

}
