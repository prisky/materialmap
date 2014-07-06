<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\SurveyResultToTicket $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="survey-result-to-ticket-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('SurveyResult')],
			['attribute' => 'ticket_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Ticket')],
		]
	]);	?>

</div>