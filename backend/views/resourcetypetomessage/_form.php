<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\ResourceTypeToMessage $model
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
            ['attribute' => 'message_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Message', [])],
            ['attribute' => 'email_html', 'type' => DetailView::INPUT_WIDGET,
				'widgetOptions' => [
					'class' => 'Zelenin\yii\widgets\Summernote\Summernote',
					'clientOptions' => [
						'codemirror' => [
							'theme' => 'monokai',
							'lineNumbers' => true,
						],
					],
				],],
            ['attribute' => 'email_subject', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 100]],
            ['attribute' => 'sms_message', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 140]],
		]
	]);	?>

</div>
