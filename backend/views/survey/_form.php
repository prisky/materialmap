<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Survey $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="survey-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'comment', 'type' => DetailView::INPUT_TEXTAREA],
			['attribute' => 'name', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
		]
	]);	?>

</div>
