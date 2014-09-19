<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Question $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="question-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'answer', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('QuestionThread', ['account_id' => $model->account_id])],
			['attribute' => 'bid_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Bid', ['account_id' => $model->account_id])],
			['attribute' => 'comment', 'type' => DetailView::INPUT_TEXTAREA],
			['attribute' => 'offer', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 7]],
		]
	]);	?>

</div>
