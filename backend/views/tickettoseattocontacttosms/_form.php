<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\TicketToSeatToContactToSms $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="ticket-to-seat-to-contact-to-sms-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account', [])],
			['attribute' => 'sms_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Sms', ['account_id' => $model->account_id])],
			['attribute' => 'ticket_to_seat_to_contact_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('TicketToSeatToContact', ['account_id' => $model->account_id])],
		]
	]);	?>

</div>
