<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * PromotionConstraintController implements the CRUD actions for PromotionConstraint model.
 */
class PromotionConstraintController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "invalid_from" => "hh:mm AM/PM on mmmm d, yy",
        "invalid_to" => "hh:mm AM/PM on mmmm d, yy"
    ];

	/**
	 * @inheritdoc
	 */
	public function getGridColumns() {
		return [
            [
                "attribute" => "invalid_from",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_invalid_from",
                    "attribute2" => "to_invalid_from"
                ],
                "filterType" => "backend\\components\\FieldRange"
            ],
            [
                "attribute" => "invalid_to",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_invalid_to",
                    "attribute2" => "to_invalid_to"
                ],
                "filterType" => "backend\\components\\FieldRange"
            ],
            [
                "attribute" => "promotion_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Promotion'),
                "value" => function ($model, $key, $index, $widget) {
								if(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->promotion->label, Url::toRoute([strtolower('Promotion') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->promotion->label, Url::toRoute([strtolower('Promotion') . "/read", "id" => $key]));
								}
								else {
									return $model->label($key);
								}
							},
                "format" => "raw"
            ]
        ];
	}

}