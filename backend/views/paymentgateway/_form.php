<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\PaymentGateway $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="payment-gateway-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'api_password', 'type' => DetailView::INPUT_PASSWORD],
			['attribute' => 'api_url', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 255]],
			['attribute' => 'api_username', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 255]],
			['attribute' => 'name', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
		]
	]);	?>

</div>
