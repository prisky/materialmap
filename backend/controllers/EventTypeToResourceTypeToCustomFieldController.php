<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * EventTypeToResourceTypeToCustomFieldController implements the CRUD actions for EventTypeToResourceTypeToCustomField model.
 */
class EventTypeToResourceTypeToCustomFieldController extends \backend\components\Controller
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
                "attribute" => "resource_type_to_custom_field_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('ResourceTypeToCustomField'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->resourceTypeToCustomField) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->resourceTypeToCustomField->label, Url::toRoute([strtolower('ResourceTypeToCustomField') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->resourceTypeToCustomField->label, Url::toRoute([strtolower('ResourceTypeToCustomField') . "/read", "id" => $key]));
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