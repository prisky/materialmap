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
        "model_id" => "#"
    ];

	/**
	 * @inheritdoc
	 */
	public function gridColumns($searchModel) {
		return [
            [
                "attribute" => "help"
            ],
            [
                "attribute" => "label"
            ],
            [
                "attribute" => "model_id",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_model_id",
                    "attribute2" => "to_model_id"
                ]
            ],
            [
                "attribute" => "name"
            ]
        ];
	}

}