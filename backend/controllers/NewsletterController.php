<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * NewsletterController implements the CRUD actions for Newsletter model.
 */
class NewsletterController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "sent" => "hh:mm AM/PM on mmmm d, yy"
    ];

	/**
	 * @inheritdoc
	 */
	public function getGridColumns() {
		return [
            [
                "attribute" => "content"
            ],
            [
                "attribute" => "sent",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_sent",
                    "attribute2" => "to_sent"
                ],
                "filterType" => "backend\\components\\FieldRange"
            ],
            [
                "attribute" => "subject"
            ]
        ];
	}

}