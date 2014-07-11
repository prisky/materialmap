<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Event $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="event-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'event_detail_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('EventDetail')],
			['attribute' => 'start', 'type' =>  DetailView::INPUT_DATETIME],
			['attribute' => 'end', 'type' =>  DetailView::INPUT_DATETIME],
			['attribute' => 'status', 'type' =>  DetailView::INPUT_DROPDOWN_LIST,
				'options' => ['prompt' => ''],
				'items' => [ "confirmed" => "Confirmed", "canceled" => "Canceled", "awaiting_mimimum" => "Awaiting mimimum" ]],
		]
	]);	?>

</div>
