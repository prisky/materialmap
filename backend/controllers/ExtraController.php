<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * ExtraController implements the CRUD actions for Extra model.
 */
class ExtraController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "mandatory" => "[=0]\"No\";[=1]\"Yes\""
    ];

	/**
	 * @inheritdoc
	 */
	public function getGridColumns() {
		return [
            [
                "attribute" => "mandatory",
                "class" => "kartik\\grid\\BooleanColumn",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_mandatory",
                    "attribute2" => "to_mandatory"
                ]
            ],
            [
                "attribute" => "maximum"
            ],
            [
                "attribute" => "minimum"
            ],
            [
                "attribute" => "name"
            ]
        ];
	}

}