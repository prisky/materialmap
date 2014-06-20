<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\AuthItemChild $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="auth-item-child-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'child', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
			['attribute' => 'account_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('AuthItem')],
		]
	]);	?>

</div>
