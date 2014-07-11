<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\TicketType $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="ticket-type-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'seats', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 5]],
			['attribute' => 'name', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
			['attribute' => 'event_max', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 5]],
			['attribute' => 'booking_max', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 5]],
			['attribute' => 'amount', 'type' =>  DetailView::INPUT_MONEY],
			['attribute' => 'comment', 'type' =>  DetailView::INPUT_TEXTAREA],
		]
	]);	?>

</div>
