<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * ColumnController implements the CRUD actions for Column model.
 */
class ColumnController extends \backend\components\Controller
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
                "attribute" => "model_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Model', ['auth_item_name' => $searchModel->auth_item_name]),
                "value" => function($model, $key, $index, $widget) {
								return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "model");
							},
                "format" => "raw"
            ],
            [
                "attribute" => "name"
            ],
            [
                "attribute" => "label"
            ],
            [
                "attribute" => "help_html"
            ]
        ];
	}

}