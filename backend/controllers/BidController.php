<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * BidController implements the CRUD actions for Bid model.
 */
class BidController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "deadline" => "hh:mm AM/PM on mmmm d, yy",
        "offer" => "#.#",
        "updated" => "hh:mm AM/PM on mmmm d, yy"
    ];

	/**
	 * @inheritdoc
	 */
	public function getGridColumns() {
		return [
            [
                "attribute" => "comment"
            ],
            [
                "attribute" => "deadline",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_deadline",
                    "attribute2" => "to_deadline"
                ],
                "filterType" => "backend\\components\\FieldRange"
            ],
            [
                "attribute" => "offer",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_offer",
                    "attribute2" => "to_offer"
                ]
            ],
            [
                "attribute" => "updated",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_updated",
                    "attribute2" => "to_updated"
                ],
                "filterType" => "backend\\components\\FieldRange"
            ]
        ];
	}

}