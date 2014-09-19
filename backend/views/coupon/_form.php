<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Coupon $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="coupon-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account', [])],
			['attribute' => 'expiry', 'type' => DetailView::INPUT_DATETIME],
			['attribute' => 'reseller_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Reseller', ['account_id' => $model->account_id])],
			['attribute' => 'uniqueid', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 13]],
		]
	]);	?>

</div>
