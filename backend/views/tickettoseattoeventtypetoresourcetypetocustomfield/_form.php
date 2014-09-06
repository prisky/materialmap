<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\TicketToSeatToEventTypeToResourceTypeToCustomField $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="ticket-to-seat-to-event-type-to-resource-type-to-custom-fie-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'ticket_to_seat_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('TicketToSeat')],
			['attribute' => 'event_type_to_resource_type_to_custom_field_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('EventTypeToResourceTypeToCustomField')],
		]
	]);	?>

</div>
