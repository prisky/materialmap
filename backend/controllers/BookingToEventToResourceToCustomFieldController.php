<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * BookingToEventToResourceToCustomFieldController implements the CRUD actions for BookingToEventToResourceToCustomField model.
 */
class BookingToEventToResourceToCustomFieldController extends \backend\components\Controller
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
                "attribute" => "event_to_resource_to_custom_field_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('EventToResourceToCustomField'),
                "value" => function ($model, $key, $index, $widget) {
								if(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->eventToResourceToCustomField->label, Url::toRoute([strtolower('EventToResourceToCustomField') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->eventToResourceToCustomField->label, Url::toRoute([strtolower('EventToResourceToCustomField') . "/read", "id" => $key]));
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