<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Bid $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="bid-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Question')],
			['attribute' => 'comment', 'type' => DetailView::INPUT_TEXTAREA],
			['attribute' => 'deadline', 'type' => DetailView::INPUT_DATETIME],
			['attribute' => 'offer', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 7]],
			['attribute' => 'updated', 'type' => DetailView::INPUT_DATETIME],
		]
	]);	?>

</div>
