<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * BidController implements the CRUD actions for Bid model.
 */
class BidController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "deadline" => "hh:mm AM/PM on mmmm d, yy",
        "offer" => "#.#",
        "updated" => "hh:mm AM/PM on mmmm d, yy"
    ];

	/**
	 * @inheritdoc
	 */
	public function getGridColumns() {
		return [
            [
                "attribute" => "comment"
            ],
            [
                "attribute" => "deadline",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_deadline",
                    "attribute2" => "to_deadline"
                ],
                "filterType" => "backend\\components\\FieldRange"
            ],
            [
                "attribute" => "offer",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_offer",
                    "attribute2" => "to_offer"
                ]
            ],
            [
                "attribute" => "question_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Question'),
                "value" => function ($model, $key, $index, $widget) {
								if(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->question->label, Url::toRoute([strtolower('Question') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->question->label, Url::toRoute([strtolower('Question') . "/read", "id" => $key]));
								}
								else {
									return $model->label($key);
								}
							},
                "format" => "raw"
            ],
            [
                "attribute" => "updated",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_updated",
                    "attribute2" => "to_updated"
                ],
                "filterType" => "backend\\components\\FieldRange"
            ]
        ];
	}

}