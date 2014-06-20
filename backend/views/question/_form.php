<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Question $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="question-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'comment', 'type' =>  DetailView::INPUT_TEXTAREA],
			['attribute' => 'bid_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Bid')],
			['attribute' => 'answer', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('QuestionThread')],
			['attribute' => 'offer', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 7]],
		]
	]);	?>

</div>
