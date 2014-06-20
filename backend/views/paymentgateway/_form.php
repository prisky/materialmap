<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\PaymentGateway $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="payment-gateway-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'name', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
		]
	]);	?>

</div>
