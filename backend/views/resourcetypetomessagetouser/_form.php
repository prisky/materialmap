<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\ResourceTypeToMessageToUser $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="resource-type-to-message-to-user-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('ResourceTypeToMessage')],
			['attribute' => 'user_id', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 10]],
		]
	]);	?>

</div>