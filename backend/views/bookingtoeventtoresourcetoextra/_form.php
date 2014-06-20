<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\BookingToEventToResourceToExtra $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="booking-to-event-to-resource-to-extra-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('EventToResourceToExtra')],
			['attribute' => 'event_to_resource_to_extra_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('EventToResourceToExtra')],
			['attribute' => 'quantity', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 5]],
			['attribute' => 'amount', 'type' =>  DetailView::INPUT_MONEY],
		]
	]);	?>

</div>
