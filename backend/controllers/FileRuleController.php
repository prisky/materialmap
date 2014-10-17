<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
* FileRuleController implements the CRUD actions for FileRule model.
*/
class FileRuleController extends \backend\components\Controller
{

    /**
     * @inheritdoc
     */
    public $excelFormats = [

    ];

    /**
     * @inheritdoc
     */
    public function gridColumns($searchModel) {
        return [
            [
                "attribute" => "column_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Column', ['auth_item_name' => $searchModel->auth_item_name, 'name' => $searchModel->column_name]),
                "value" => function($model, $key, $index, $widget) {
                                return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "column");
                            },
                "format" => "raw"
            ],
            [
                "attribute" => "validator"
            ],
            [
                "attribute" => "key"
            ],
            [
                "attribute" => "value"
            ]
        ];
    }

}
