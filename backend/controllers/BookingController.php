<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * BookingController implements the CRUD actions for Booking model.
 */
class BookingController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [

    ];

	/**
	 * @inheritdoc
	 */
	public function getGridColumns() {
		return [
            [
                "attribute" => "status",
                "filter" => [
                    "processing" => "processing",
                    "booked" => "booked",
                    "canceled" => "canceled",
                    "wait_listed" => "wait_listed"
                ]
            ],
            [
                "attribute" => "summary_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Summary'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->summary) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->summary->label, Url::toRoute([strtolower('Summary') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->summary->label, Url::toRoute([strtolower('Summary') . "/read", "id" => $key]));
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