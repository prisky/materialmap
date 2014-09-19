<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\MessageQueue $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="message-queue-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'id', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 10]],
			['attribute' => 'to', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Contact', [])],
			['attribute' => 'from', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account', [])],
			['attribute' => 'email_message', 'type' => DetailView::INPUT_TEXTAREA],
			['attribute' => 'email_subject', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 100]],
			['attribute' => 'sms_message', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 140]],
			['attribute' => 'created', 'type' => DetailView::INPUT_DATETIME],
		]
	]);	?>

</div>
