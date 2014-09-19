<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * ResourceTypeToMessageToUserController implements the CRUD actions for ResourceTypeToMessageToUser model.
 */
class ResourceTypeToMessageToUserController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "user_id" => "#"
    ];

	/**
	 * @inheritdoc
	 */
	public function gridColumns($searchModel) {
		return [
            [
                "attribute" => "user_id",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_user_id",
                    "attribute2" => "to_user_id"
                ]
            ]
        ];
	}

}