<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * EventDetailController implements the CRUD actions for EventDetail model.
 */
class EventDetailController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "deposit" => "#.#"
    ];

	/**
	 * @inheritdoc
	 */
	public function getGridColumns() {
		return [
            [
                "attribute" => "deposit",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_deposit",
                    "attribute2" => "to_deposit"
                ]
            ],
            [
                "attribute" => "deposit_hours"
            ],
            [
                "attribute" => "name"
            ],
            [
                "attribute" => "private_note"
            ],
            [
                "attribute" => "resource_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Resource'),
                "value" => function ($model, $key, $index, $widget) {
								if(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->resource->label, Url::toRoute([strtolower('Resource') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->resource->label, Url::toRoute([strtolower('Resource') . "/read", "id" => $key]));
								}
								else {
									return $model->label($key);
								}
							},
                "format" => "raw"
            ],
            [
                "attribute" => "seats_max"
            ],
            [
                "attribute" => "seats_min"
            ],
            [
                "attribute" => "seats_min_hours"
            ],
            [
                "attribute" => "tooltip"
            ]
        ];
	}

}