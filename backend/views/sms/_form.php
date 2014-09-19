<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Sms $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="sms-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'contact_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Contact', [])],
			['attribute' => 'outgoing', 'type' => DetailView::INPUT_SWITCH],
			['attribute' => 'sms_message', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 140]],
		]
	]);	?>

</div>
