<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Comment $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="comment-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account')],
			['attribute' => 'content', 'type' => DetailView::INPUT_TEXTAREA],
			['attribute' => 'email', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 255]],
		]
	]);	?>

</div>
