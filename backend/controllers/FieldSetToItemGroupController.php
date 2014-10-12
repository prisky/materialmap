<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
* FieldSetToItemGroupController implements the CRUD actions for FieldSetToItemGroup model.
*/
class FieldSetToItemGroupController extends \backend\components\Controller
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
                "attribute" => "item_group_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('ItemGroup', ['account_id' => $searchModel->account_id]),
                "value" => function($model, $key, $index, $widget) {
                                return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "itemGroup");
                            },
                "format" => "raw"
            ]
        ];
    }

}
