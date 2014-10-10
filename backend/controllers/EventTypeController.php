<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * EventTypeController implements the CRUD actions for EventType model.
 */
class EventTypeController extends \backend\components\Controller
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
                "attribute" => "name"
            ],
            [
                "attribute" => "seats_max"
            ],
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
                "attribute" => "seats_min"
            ],
            [
                "attribute" => "seats_min_hours"
            ],
            [
                "attribute" => "private_note"
            ],
            [
                "attribute" => "tooltip"
            ]
        ];
	}

}