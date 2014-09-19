<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * PaymentGatewayController implements the CRUD actions for PaymentGateway model.
 */
class PaymentGatewayController extends \backend\components\Controller
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
                "attribute" => "api_url"
            ],
            [
                "attribute" => "api_username"
            ],
            [
                "attribute" => "name"
            ]
        ];
	}

}