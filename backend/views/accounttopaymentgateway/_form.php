<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\AccountToPaymentGateway $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="account-to-payment-gateway-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'payment_gateway_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('PaymentGateway')],
		]
	]);	?>

</div>
