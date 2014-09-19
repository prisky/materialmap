<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\ResourceTypeToMessage $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="resource-type-to-message-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'email_message', 'type' => DetailView::INPUT_TEXTAREA],
			['attribute' => 'email_subject', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 100]],
			['attribute' => 'message_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Message', [])],
			['attribute' => 'sms_message', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 140]],
		]
	]);	?>

</div>
