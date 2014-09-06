<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * SummaryToPercentVoucherController implements the CRUD actions for SummaryToPercentVoucher model.
 */
class SummaryToPercentVoucherController extends \backend\components\Controller
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
                "attribute" => "percent_voucher_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('PercentVoucher'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->percentVoucher) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->percentVoucher->label, Url::toRoute([strtolower('PercentVoucher') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->percentVoucher->label, Url::toRoute([strtolower('PercentVoucher') . "/read", "id" => $key]));
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