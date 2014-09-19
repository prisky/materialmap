<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\SurveyResultToTicketToSeat $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="survey-result-to-ticket-to-seat-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'custom_field_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('CustomField', ['account_id' => $model->account_id])],
			['attribute' => 'custom_value', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 255]],
			['attribute' => 'ticket_to_seat_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('TicketToSeat', ['account_id' => $model->account_id])],
		]
	]);	?>

</div>
