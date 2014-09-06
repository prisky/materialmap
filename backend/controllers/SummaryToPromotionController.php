<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * SummaryToPromotionController implements the CRUD actions for SummaryToPromotion model.
 */
class SummaryToPromotionController extends \backend\components\Controller
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
                "attribute" => "promotion_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Promotion'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->promotion) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->promotion->label, Url::toRoute([strtolower('Promotion') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->promotion->label, Url::toRoute([strtolower('Promotion') . "/read", "id" => $key]));
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