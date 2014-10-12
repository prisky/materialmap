<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
* CountryController implements the CRUD actions for Country model.
*/
class CountryController extends \backend\components\Controller
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
                "attribute" => "code"
            ],
            [
                "attribute" => "currency_code"
            ],
            [
                "attribute" => "currency_symbol"
            ],
            [
                "attribute" => "phone_prefix"
            ],
            [
                "attribute" => "tax_name"
            ]
        ];
    }

}
