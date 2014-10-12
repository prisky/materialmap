<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\SeatToTicketType $model
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
            ['attribute' => 'ticket_type_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('TicketType', ['account_id' => $model->account_id])
            ],
		]
	]);	?>

</div>
