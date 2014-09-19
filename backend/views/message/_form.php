<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Message $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="message-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'email_html', 'type' => DetailView::INPUT_TEXTAREA],
			['attribute' => 'email_subject', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 100]],
			['attribute' => 'name', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 255]],
			['attribute' => 'sms_text', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 140]],
			['attribute' => 'system', 'type' => DetailView::INPUT_SWITCH],
		]
	]);	?>

</div>
