<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
* SeatController implements the CRUD actions for Seat model.
*/
class SeatController extends \backend\components\Controller
{

    /**
     * @inheritdoc
     */
    public $excelFormats = [
        "root" => "#",
        "lft" => "#",
        "rgt" => "#",
        "level" => "#"
    ];

    /**
     * @inheritdoc
     */
    public function gridColumns($searchModel) {
        return [
            [
                "attribute" => "resource_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Resource', ['account_id' => $searchModel->account_id]),
                "value" => function($model, $key, $index, $widget) {
                                return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "resource");
                            },
                "format" => "raw"
            ],
            [
                "attribute" => "root",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_root",
                    "attribute2" => "to_root"
                ]
            ],
            [
                "attribute" => "lft",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_lft",
                    "attribute2" => "to_lft"
                ]
            ],
            [
                "attribute" => "rgt",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_rgt",
                    "attribute2" => "to_rgt"
                ]
            ],
            [
                "attribute" => "level",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_level",
                    "attribute2" => "to_level"
                ]
            ],
            [
                "attribute" => "name"
            ],
            [
                "attribute" => "x"
            ],
            [
                "attribute" => "y"
            ]
        ];
    }

}
