<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * PaypalSubCategoryController implements the CRUD actions for PaypalSubCategory model.
 */
class PaypalSubCategoryController extends \backend\components\Controller
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
                "attribute" => "name"
            ],
            [
                "attribute" => "paypal_category_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('PaypalCategory'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->paypalCategory) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->paypalCategory->label, Url::toRoute([strtolower('PaypalCategory') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->paypalCategory->label, Url::toRoute([strtolower('PaypalCategory') . "/read", "id" => $key]));
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