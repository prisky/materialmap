<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\TicketToSeat $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="ticket-to-seat-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'seat_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Seat', ['account_id' => $model->account_id])],
		]
	]);	?>

</div>
