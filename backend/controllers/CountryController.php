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
	public function getGridColumns() {
		return [
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
                "attribute" => "name"
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