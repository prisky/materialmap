<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * AccountToPaymentGatewayController implements the CRUD actions for AccountToPaymentGateway model.
 */
class AccountToPaymentGatewayController extends \backend\components\Controller
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
                "attribute" => "payment_gateway_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('PaymentGateway'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->paymentGateway) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->paymentGateway->label, Url::toRoute([strtolower('PaymentGateway') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->paymentGateway->label, Url::toRoute([strtolower('PaymentGateway') . "/read", "id" => $key]));
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