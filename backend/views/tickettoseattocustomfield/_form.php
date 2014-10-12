<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\TicketToSeatToCustomField $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="form-container">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
            ['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account', [])
            ],
            ['attribute' => 'ticket_to_seat_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('TicketToSeat', ['account_id' => $model->account_id, 'event_type_id' => $model->event_type_id])
            ],
            ['attribute' => 'custom_value', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 255]
            ],
		]
	]);	?>

</div>
