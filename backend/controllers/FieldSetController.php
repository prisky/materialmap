<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * FieldSetController implements the CRUD actions for FieldSet model.
 */
class FieldSetController extends \backend\components\Controller
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
                "attribute" => "level",
                "filter" => [
                    "Summary" => "Summary",
                    "Booking" => "Booking",
                    "Ticket" => "Ticket",
                    "Ticket to seat" => "Ticket to seat"
                ]
            ]
        ];
	}

}