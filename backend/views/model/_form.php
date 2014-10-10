<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Model $model
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
            ['attribute' => 'label', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
            ['attribute' => 'label_plural', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
            ['attribute' => 'help_html', 'type' => DetailView::INPUT_WIDGET,
				'widgetOptions' => [
					'class' => 'Zelenin\yii\widgets\Summernote\Summernote',
					'clientOptions' => [
						'codemirror' => [
							'theme' => 'monokai',
							'lineNumbers' => true,
						],
					],
				],],
		]
	]);	?>

</div>
