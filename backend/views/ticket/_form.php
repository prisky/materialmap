<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Ticket $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="ticket-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('TicketType')],
			['attribute' => 'ticket_type_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('TicketType')],
			['attribute' => 'event_type_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Booking')],
			['attribute' => 'amount', 'type' => DetailView::INPUT_MONEY],
		]
	]);	?>

</div>
