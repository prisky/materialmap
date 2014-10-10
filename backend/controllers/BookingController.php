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
	public function gridColumns($searchModel) {
		return [
            [
                "attribute" => "summary_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Summary', ['account_id' => $searchModel->account_id]),
                "value" => function($model, $key, $index, $widget) {
								return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "summary");
							},
                "format" => "raw"
            ],
            [
                "attribute" => "status",
                "filter" => [
                    "processing" => "processing",
                    "booked" => "booked",
                    "canceled" => "canceled",
                    "wait_listed" => "wait_listed"
                ]
            ]
        ];
	}

}