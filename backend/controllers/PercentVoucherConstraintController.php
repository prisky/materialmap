<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * PercentVoucherConstraintController implements the CRUD actions for PercentVoucherConstraint model.
 */
class PercentVoucherConstraintController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "invalaid_to" => "hh:mm AM/PM on mmmm d, yy",
        "invalid_from" => "hh:mm AM/PM on mmmm d, yy"
    ];

	/**
	 * @inheritdoc
	 */
	public function getGridColumns() {
		return [
            [
                "attribute" => "invalaid_to",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_invalaid_to",
                    "attribute2" => "to_invalaid_to"
                ],
                "filterType" => "backend\\components\\FieldRange"
            ],
            [
                "attribute" => "invalid_from",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_invalid_from",
                    "attribute2" => "to_invalid_from"
                ],
                "filterType" => "backend\\components\\FieldRange"
            ]
        ];
	}

}