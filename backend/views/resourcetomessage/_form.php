<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\ResourceToMessage $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="resource-to-message-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Resource')],
			['attribute' => 'message_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Message')],
			['attribute' => 'email_message', 'type' => DetailView::INPUT_TEXTAREA],
			['attribute' => 'sms_message', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 140]],
			['attribute' => 'email_submect', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 100]],
		]
	]);	?>

</div>
