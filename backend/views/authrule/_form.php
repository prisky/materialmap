<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\AuthRule $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="auth-rule-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'id', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 10]],
			['attribute' => 'name', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
			['attribute' => 'data', 'type' => DetailView::INPUT_TEXTAREA],
			['attribute' => 'created_at', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 11]],
			['attribute' => 'updated_at', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 11]],
		]
	]);	?>

</div>
