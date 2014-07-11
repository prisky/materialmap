<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * TicketToSeatToContactController implements the CRUD actions for TicketToSeatToContact model.
 */
class TicketToSeatToContactController extends \backend\components\Controller
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
                "attribute" => "contact_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Contact'),
                "value" => function ($model, $key, $index, $widget) {
								if(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->contact->label, Url::toRoute([strtolower('Contact') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->contact->label, Url::toRoute([strtolower('Contact') . "/read", "id" => $key]));
								}
								else {
									return $model->label($key);
								}
							},
                "format" => "raw"
            ],
            [
                "attribute" => "ticket_to_seat_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('TicketToSeat'),
                "value" => function ($model, $key, $index, $widget) {
								if(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->ticketToSeat->label, Url::toRoute([strtolower('TicketToSeat') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->ticketToSeat->label, Url::toRoute([strtolower('TicketToSeat') . "/read", "id" => $key]));
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