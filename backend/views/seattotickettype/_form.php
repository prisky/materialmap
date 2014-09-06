<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\SeatToTicketType $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="seat-to-ticket-type-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('TicketType')],
			['attribute' => 'ticket_type_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('TicketType')],
		]
	]);	?>

</div>
