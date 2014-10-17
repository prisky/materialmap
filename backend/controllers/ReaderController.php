<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
* ReaderController implements the CRUD actions for Reader model.
*/
class ReaderController extends \backend\components\Controller
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
                "attribute" => "name"
            ],
            [
                "attribute" => "activation",
                "filter" => [
                    "Active" => "Active",
                    "Inactive" => "Inactive"
                ]
            ]
        ];
    }

}
