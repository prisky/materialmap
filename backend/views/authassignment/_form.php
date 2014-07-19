<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\AuthAssignment $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="auth-assignment-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'item_name', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
			['attribute' => 'created_at', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 11]],
		]
	]);	?>

</div>
