<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * AuthItemController implements the CRUD actions for AuthItem model.
 */
class AuthItemController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "created_at" => "#",
        "type" => "#",
        "updated_at" => "#"
    ];

	/**
	 * @inheritdoc
	 */
	public function getGridColumns() {
		return [
            [
                "attribute" => "created_at",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_created_at",
                    "attribute2" => "to_created_at"
                ]
            ],
            [
                "attribute" => "data"
            ],
            [
                "attribute" => "description"
            ],
            [
                "attribute" => "name"
            ],
            [
                "attribute" => "rule_name"
            ],
            [
                "attribute" => "type",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_type",
                    "attribute2" => "to_type"
                ]
            ],
            [
                "attribute" => "updated_at",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_updated_at",
                    "attribute2" => "to_updated_at"
                ]
            ]
        ];
	}

}