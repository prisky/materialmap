<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Extra $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="extra-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'mandatory', 'type' =>  DetailView::INPUT_SWITCH],
			['attribute' => 'minimum', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 5]],
			['attribute' => 'maximum', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 5]],
			['attribute' => 'name', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
		]
	]);	?>

</div>
