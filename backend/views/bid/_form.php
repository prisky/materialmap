<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Bid $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="bid-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account', [])],
			['attribute' => 'comment', 'type' => DetailView::INPUT_TEXTAREA],
			['attribute' => 'deadline', 'type' => DetailView::INPUT_DATETIME],
			['attribute' => 'offer', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 7]],
			['attribute' => 'question_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Question', ['account_id' => $model->account_id])],
			['attribute' => 'updated', 'type' => DetailView::INPUT_DATETIME],
		]
	]);	?>

</div>
