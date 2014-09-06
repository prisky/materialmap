<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Model $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="model-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'auth_item_name', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
			['attribute' => 'help', 'type' => DetailView::INPUT_TEXTAREA],
			['attribute' => 'label', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
			['attribute' => 'label_plural', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
		]
	]);	?>

</div>
