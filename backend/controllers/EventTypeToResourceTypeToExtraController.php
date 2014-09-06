<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * EventTypeToResourceTypeToExtraController implements the CRUD actions for EventTypeToResourceTypeToExtra model.
 */
class EventTypeToResourceTypeToExtraController extends \backend\components\Controller
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
                "attribute" => "event_type_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('EventType'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->eventType) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->eventType->label, Url::toRoute([strtolower('EventType') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->eventType->label, Url::toRoute([strtolower('EventType') . "/read", "id" => $key]));
								}
								else {
									return $model->label($key);
								}
							},
                "format" => "raw"
            ],
            [
                "attribute" => "resource_type_to_extra_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('ResourceTypeToExtra'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->resourceTypeToExtra) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->resourceTypeToExtra->label, Url::toRoute([strtolower('ResourceTypeToExtra') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->resourceTypeToExtra->label, Url::toRoute([strtolower('ResourceTypeToExtra') . "/read", "id" => $key]));
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