<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * ModelController implements the CRUD actions for Model model.
 */
class ModelController extends \backend\components\Controller
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
                "attribute" => "label_plural"
            ]
        ];
	}

}