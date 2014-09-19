<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\AuthItem $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="auth-item-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'created_at', 'type' => DetailView::INPUT_DATETIME],
			['attribute' => 'data', 'type' => DetailView::INPUT_TEXTAREA],
			['attribute' => 'description', 'type' => DetailView::INPUT_TEXTAREA],
			['attribute' => 'name', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
			['attribute' => 'rule_name', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
			['attribute' => 'type', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 11]],
			['attribute' => 'updated_at', 'type' => DetailView::INPUT_DATETIME],
		]
	]);	?>

</div>
