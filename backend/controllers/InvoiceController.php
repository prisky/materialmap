<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * InvoiceController implements the CRUD actions for Invoice model.
 */
class InvoiceController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "invoiced" => "hh:mm AM/PM on mmmm d, yy",
        "paid" => "hh:mm AM/PM on mmmm d, yy"
    ];

	/**
	 * @inheritdoc
	 */
	public function getGridColumns() {
		return [
            [
                "attribute" => "account_to_user_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('AccountToUser'),
                "value" => function ($model, $key, $index, $widget) {
								if(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->accountToUser->label, Url::toRoute([strtolower('AccountToUser') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->accountToUser->label, Url::toRoute([strtolower('AccountToUser') . "/read", "id" => $key]));
								}
								else {
									return $model->label($key);
								}
							},
                "format" => "raw"
            ],
            [
                "attribute" => "invoiced",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_invoiced",
                    "attribute2" => "to_invoiced"
                ],
                "filterType" => "backend\\components\\FieldRange"
            ],
            [
                "attribute" => "paid",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_paid",
                    "attribute2" => "to_paid"
                ],
                "filterType" => "backend\\components\\FieldRange"
            ]
        ];
	}

}