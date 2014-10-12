<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\TicketToSeatToItem $model
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
            ['attribute' => 'item_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Item', ['account_id' => $model->account_id, 'item_group_id' => $model->item_group_id])
            ],
            ['attribute' => 'amount', 'type' => DetailView::INPUT_MONEY
            ],
            ['attribute' => 'quantity', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 6]
            ],
		]
	]);	?>

</div>
