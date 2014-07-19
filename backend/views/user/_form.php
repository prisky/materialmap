<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="user-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'contact_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Contact')],
			['attribute' => 'auth_key', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 32]],
			['attribute' => 'password_hash', 'type' => DetailView::INPUT_PASSWORD],
			['attribute' => 'password_reset_token', 'type' => DetailView::INPUT_PASSWORD],
		]
	]);	?>

</div>
