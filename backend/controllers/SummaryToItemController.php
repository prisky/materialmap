<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * SummaryToItemController implements the CRUD actions for SummaryToItem model.
 */
class SummaryToItemController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "amount" => "\$#,##0.00;[Red]-\$#,##0.00"
    ];

	/**
	 * @inheritdoc
	 */
	public function getGridColumns() {
		return [
            [
                "attribute" => "amount",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_amount",
                    "attribute2" => "to_amount",
                    "type" => "widget",
                    "widgetClass" => "\\kartik\\money\\MaskMoney",
                    "widgetOptions1" => [
                        "pluginOptions" => [
                            "allowEmpty" => TRUE
                        ]
                    ],
                    "widgetOptions2" => [
                        "pluginOptions" => [
                            "allowEmpty" => TRUE
                        ]
                    ]
                ]
            ],
            [
                "attribute" => "field_set_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('FieldSetToItemGroup'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->fieldSetToItemGroup) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->fieldSetToItemGroup->label, Url::toRoute([strtolower('FieldSetToItemGroup') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->fieldSetToItemGroup->label, Url::toRoute([strtolower('FieldSetToItemGroup') . "/read", "id" => $key]));
								}
								else {
									return $model->label($key);
								}
							},
                "format" => "raw"
            ],
            [
                "attribute" => "item_group_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Item'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->item) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->item->label, Url::toRoute([strtolower('Item') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->item->label, Url::toRoute([strtolower('Item') . "/read", "id" => $key]));
								}
								else {
									return $model->label($key);
								}
							},
                "format" => "raw"
            ],
            [
                "attribute" => "item_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Item'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->item) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->item->label, Url::toRoute([strtolower('Item') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->item->label, Url::toRoute([strtolower('Item') . "/read", "id" => $key]));
								}
								else {
									return $model->label($key);
								}
							},
                "format" => "raw"
            ],
            [
                "attribute" => "quantity"
            ],
            [
                "attribute" => "summary_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Summary'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->summary) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->summary->label, Url::toRoute([strtolower('Summary') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->summary->label, Url::toRoute([strtolower('Summary') . "/read", "id" => $key]));
								}
								else {
									return $model->label($key);
								}
							},
                "format" => "raw"
            ]
        ];
	}

}