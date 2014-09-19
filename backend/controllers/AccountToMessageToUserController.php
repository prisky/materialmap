<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * AccountToMessageToUserController implements the CRUD actions for AccountToMessageToUser model.
 */
class AccountToMessageToUserController extends \backend\components\Controller
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
                "attribute" => "account_to_message",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('AccountToMessage', ['account_id' => $searchModel->account_id]),
                "value" => function($model, $key, $index, $widget) {
								return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "accountToMessage");
							},
                "format" => "raw"
            ],
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