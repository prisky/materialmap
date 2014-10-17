<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
* RfidTagController implements the CRUD actions for RfidTag model.
*/
class RfidTagController extends \backend\components\Controller
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
                "attribute" => "activation",
                "filter" => [
                    "Active" => "Active",
                    "Inactive" => "Inactive"
                ]
            ],
            [
                "attribute" => "name_plate"
            ],
            [
                "attribute" => "commodity_code"
            ]
        ];
    }

}
