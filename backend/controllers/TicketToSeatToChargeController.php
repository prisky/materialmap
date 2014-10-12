<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
* TicketToSeatToChargeController implements the CRUD actions for TicketToSeatToCharge model.
*/
class TicketToSeatToChargeController extends \backend\components\Controller
{

    /**
     * @inheritdoc
     */
    public $excelFormats = [

    ];

    /**
     * @inheritdoc
     */
    public function gridColumns($searchModel) {
        return [
            [
                "attribute" => "account_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Account', []),
                "value" => function($model, $key, $index, $widget) {
                                return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "account");
                            },
                "format" => "raw"
            ],
            [
                "attribute" => "ticket_to_seat_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('TicketToSeat', ['account_id' => $searchModel->account_id]),
                "value" => function($model, $key, $index, $widget) {
                                return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "ticketToSeat");
                            },
                "format" => "raw"
            ],
            [
                "attribute" => "charge_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Charge', ['account_id' => $searchModel->account_id]),
                "value" => function($model, $key, $index, $widget) {
                                return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "charge");
                            },
                "format" => "raw"
            ]
        ];
    }

}
