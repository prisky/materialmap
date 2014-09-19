<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\TicketToSeatToCharge $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="ticket-to-seat-to-charge-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account', [])],
			['attribute' => 'charge_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Charge', ['account_id' => $model->account_id])],
			['attribute' => 'ticket_to_seat_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('TicketToSeat', ['account_id' => $model->account_id])],
		]
	]);	?>

</div>
