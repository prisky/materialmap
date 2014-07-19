<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * ColumnController implements the CRUD actions for Column model.
 */
class ColumnController extends \backend\components\Controller
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
                "attribute" => "help"
            ],
            [
                "attribute" => "label"
            ],
            [
                "attribute" => "name"
            ]
        ];
	}

}