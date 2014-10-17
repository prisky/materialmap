<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
* BomController implements the CRUD actions for Bom model.
*/
class BomController extends \backend\components\Controller
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
                "attribute" => "commodity_code_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('CommodityCode', []),
                "value" => function($model, $key, $index, $widget) {
                                return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "commodityCode");
                            },
                "format" => "raw"
            ],
            [
                "attribute" => "name"
            ],
            [
                "attribute" => "size1"
            ],
            [
                "attribute" => "size2"
            ],
            [
                "attribute" => "wbs"
            ]
        ];
    }

}
