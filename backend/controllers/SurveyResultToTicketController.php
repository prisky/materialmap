<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * SurveyResultToTicketController implements the CRUD actions for SurveyResultToTicket model.
 */
class SurveyResultToTicketController extends \backend\components\Controller
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
                "attribute" => "custom_field_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('FieldSetToCustomField'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->fieldSetToCustomField) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->fieldSetToCustomField->label, Url::toRoute([strtolower('FieldSetToCustomField') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->fieldSetToCustomField->label, Url::toRoute([strtolower('FieldSetToCustomField') . "/read", "id" => $key]));
								}
								else {
									return $model->label($key);
								}
							},
                "format" => "raw"
            ],
            [
                "attribute" => "custom_value"
            ],
            [
                "attribute" => "field_set_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('SurveyToFieldSet'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->surveyToFieldSet) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->surveyToFieldSet->label, Url::toRoute([strtolower('SurveyToFieldSet') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->surveyToFieldSet->label, Url::toRoute([strtolower('SurveyToFieldSet') . "/read", "id" => $key]));
								}
								else {
									return $model->label($key);
								}
							},
                "format" => "raw"
            ],
            [
                "attribute" => "survey_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('SurveyToFieldSet'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->surveyToFieldSet) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->surveyToFieldSet->label, Url::toRoute([strtolower('SurveyToFieldSet') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->surveyToFieldSet->label, Url::toRoute([strtolower('SurveyToFieldSet') . "/read", "id" => $key]));
								}
								else {
									return $model->label($key);
								}
							},
                "format" => "raw"
            ],
            [
                "attribute" => "ticket_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Ticket'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->ticket) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->ticket->label, Url::toRoute([strtolower('Ticket') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->ticket->label, Url::toRoute([strtolower('Ticket') . "/read", "id" => $key]));
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