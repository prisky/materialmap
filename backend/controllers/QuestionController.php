<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class QuestionController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "offer" => "#.#"
    ];

	/**
	 * @inheritdoc
	 */
	public function gridColumns($searchModel) {
		return [
            [
                "attribute" => "answer",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('QuestionThread', ['account_id' => $searchModel->account_id]),
                "value" => function($model, $key, $index, $widget) {
								return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "questionThread");
							},
                "format" => "raw"
            ],
            [
                "attribute" => "bid_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Bid', ['account_id' => $searchModel->account_id]),
                "value" => function($model, $key, $index, $widget) {
								return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "bid");
							},
                "format" => "raw"
            ],
            [
                "attribute" => "comment"
            ],
            [
                "attribute" => "offer",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_offer",
                    "attribute2" => "to_offer"
                ]
            ]
        ];
	}

}