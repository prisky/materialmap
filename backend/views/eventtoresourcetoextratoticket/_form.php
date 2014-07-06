<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\EventToResourceToExtraToTicket $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="event-to-resource-to-extra-to-ticket-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('EventToResourceToExtra')],
			['attribute' => 'ticket_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Ticket')],
			['attribute' => 'quantity', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 5]],
			['attribute' => 'amount', 'type' =>  DetailView::INPUT_MONEY],
		]
	]);	?>

</div>