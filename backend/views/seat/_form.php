<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Seat $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="seat-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'resource_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Resource')],
			['attribute' => 'seat_type_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('SeatType')],
			['attribute' => 'root', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 10]],
			['attribute' => 'lft', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 10]],
			['attribute' => 'rgt', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 10]],
			['attribute' => 'level', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 10]],
			['attribute' => 'name', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
			['attribute' => 'x', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 5]],
			['attribute' => 'y', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 5]],
		]
	]);	?>

</div>
