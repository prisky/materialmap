<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\SmsThread $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="sms-thread-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account')],
		]
	]);	?>

</div>
