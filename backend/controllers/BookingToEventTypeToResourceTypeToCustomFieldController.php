<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * BookingToEventTypeToResourceTypeToCustomFieldController implements the CRUD actions for BookingToEventTypeToResourceTypeToCustomField model.
 */
class BookingToEventTypeToResourceTypeToCustomFieldController extends \backend\components\Controller
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
                "attribute" => "custom_value"
            ],
            [
                "attribute" => "event_type_to_resource_type_to_custom_field_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('EventTypeToResourceTypeToCustomField'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->eventTypeToResourceTypeToCustomField) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->eventTypeToResourceTypeToCustomField->label, Url::toRoute([strtolower('EventTypeToResourceTypeToCustomField') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->eventTypeToResourceTypeToCustomField->label, Url::toRoute([strtolower('EventTypeToResourceTypeToCustomField') . "/read", "id" => $key]));
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