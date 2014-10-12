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
