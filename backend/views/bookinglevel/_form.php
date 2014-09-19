<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\BookingLevel $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="booking-level-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'id', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 3]],
		]
	]);	?>

</div>
