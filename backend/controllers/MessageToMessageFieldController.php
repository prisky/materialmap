<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * MessageToMessageFieldController implements the CRUD actions for MessageToMessageField model.
 */
class MessageToMessageFieldController extends \backend\components\Controller
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
                "attribute" => "message_field_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('MessageField', []),
                "value" => function($model, $key, $index, $widget) {
								return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "messageField");
							},
                "format" => "raw"
            ]
        ];
	}

}