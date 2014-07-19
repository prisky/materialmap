<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Sms $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="sms-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account')],
			['attribute' => 'contact_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Contact')],
			['attribute' => 'sms_message', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 140]],
			['attribute' => 'outgoing', 'type' => DetailView::INPUT_SWITCH],
		]
	]);	?>

</div>
