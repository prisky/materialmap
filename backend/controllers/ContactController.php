<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * ContactController implements the CRUD actions for Contact model.
 */
class ContactController extends \backend\components\Controller
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
                "attribute" => "email"
            ],
            [
                "attribute" => "first_name"
            ],
            [
                "attribute" => "last_name"
            ],
            [
                "attribute" => "phone_mobile"
            ]
        ];
	}

}