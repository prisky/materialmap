<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * CustomFieldController implements the CRUD actions for CustomField model.
 */
class CustomFieldController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "allow_new" => "[=0]\"No\";[=1]\"Yes\"",
        "mandatory" => "[=0]\"No\";[=1]\"Yes\""
    ];

	/**
	 * @inheritdoc
	 */
	public function gridColumns($searchModel) {
		return [
            [
                "attribute" => "allow_new",
                "class" => "kartik\\grid\\BooleanColumn",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_allow_new",
                    "attribute2" => "to_allow_new"
                ]
            ],
            [
                "attribute" => "comment"
            ],
            [
                "attribute" => "data_type",
                "filter" => [
                    "Date" => "Date",
                    "Float" => "Float",
                    "Int" => "Int",
                    "Text" => "Text",
                    "Time" => "Time"
                ]
            ],
            [
                "attribute" => "label"
            ],
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
                "attribute" => "validation_error"
            ],
            [
                "attribute" => "validation_text"
            ],
            [
                "attribute" => "validation_type",
                "filter" => [
                    "Date" => "Date",
                    "Float" => "Float",
                    "Int" => "Int",
                    "Text" => "Text",
                    "Time" => "Time",
                    "None" => "None",
                    "PCRE" => "PCRE",
                    "Range" => "Range",
                    "Value list" => "Value list"
                ]
            ]
        ];
	}

}