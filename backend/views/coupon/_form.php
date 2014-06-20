<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Coupon $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="coupon-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'reseller_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Reseller')],
			['attribute' => 'uniqueid', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 13]],
			['attribute' => 'expiry', 'type' =>  DetailView::INPUT_DATETIME],
		]
	]);	?>

</div>
