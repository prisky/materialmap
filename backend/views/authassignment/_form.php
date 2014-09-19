<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\AuthAssignment $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="auth-assignment-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'created_at', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 11]],
			['attribute' => 'user_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('User', [])],
		]
	]);	?>

</div>
