<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\AccountToUser $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="account-to-user-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'immediate', 'type' => DetailView::INPUT_SWITCH],
			['attribute' => 'newsletter', 'type' => DetailView::INPUT_SWITCH],
			['attribute' => 'rate', 'type' => DetailView::INPUT_SPIN],
			['attribute' => 'user_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('User', [])],
		]
	]);	?>

</div>
