<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
* CommodityCodeController implements the CRUD actions for CommodityCode model.
*/
class CommodityCodeController extends \backend\components\Controller
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
                "attribute" => "code"
            ],
            [
                "attribute" => "description"
            ],
            [
                "attribute" => "purchase_description"
            ]
        ];
    }

}
