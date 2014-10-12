<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
* FieldSetTreeController implements the CRUD actions for FieldSetTree model.
*/
class FieldSetTreeController extends \backend\components\Controller
{

    /**
     * @inheritdoc
     */
    public $excelFormats = [
        "depth" => "#"
    ];

    /**
     * @inheritdoc
     */
    public function gridColumns($searchModel) {
        return [
            [
                "attribute" => "child_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('FieldSet', ['account_id' => $searchModel->account_id]),
                "value" => function($model, $key, $index, $widget) {
                                return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "fieldSet");
                            },
                "format" => "raw"
            ],
            [
                "attribute" => "depth",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_depth",
                    "attribute2" => "to_depth"
                ]
            ]
        ];
    }

}
