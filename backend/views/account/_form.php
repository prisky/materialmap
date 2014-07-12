<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Account $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="account-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'user_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('User')],
			['attribute' => 'address_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Address')],
			['attribute' => 'phone_work', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 20]],
			['attribute' => 'balance', 'type' =>  DetailView::INPUT_MONEY],
			['attribute' => 'summary_charge', 'type' =>  DetailView::INPUT_MONEY],
			['attribute' => 'booking_charge', 'type' =>  DetailView::INPUT_MONEY],
			['attribute' => 'ticket_charge', 'type' =>  DetailView::INPUT_MONEY],
			['attribute' => 'seat_charge', 'type' =>  DetailView::INPUT_MONEY],
			['attribute' => 'sms_charge', 'type' =>  DetailView::INPUT_MONEY],
			['attribute' => 'annual_charge', 'type' =>  DetailView::INPUT_MONEY],
			['attribute' => 'rate', 'type' =>  DetailView::INPUT_SPIN],
		]
	]);	?>

</div>
