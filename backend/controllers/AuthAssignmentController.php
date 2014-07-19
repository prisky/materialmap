<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * AuthAssignmentController implements the CRUD actions for AuthAssignment model.
 */
class AuthAssignmentController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "created_at" => "#"
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
                "attribute" => "item_name"
            ]
        ];
	}

}