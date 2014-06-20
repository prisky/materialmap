<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Message $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="message-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'system', 'type' =>  DetailView::INPUT_SWITCH],
			['attribute' => 'email_html', 'type' =>  DetailView::INPUT_TEXTAREA],
			['attribute' => 'sms_text', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 140]],
			['attribute' => 'email_subject', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 100]],
			['attribute' => 'name', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 255]],
		]
	]);	?>

</div>
