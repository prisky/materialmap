<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Payment $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="payment-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'summary_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Summary')],
			['attribute' => 'payment_gateway_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('PaymentGateway')],
			['attribute' => 'uniqueid', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 13]],
			['attribute' => 'amount', 'type' =>  DetailView::INPUT_MONEY],
		]
	]);	?>

</div>
