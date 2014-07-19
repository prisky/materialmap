<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\CancellatonPolicyBlackhole $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="cancellaton-policy-blackhole-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'id', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 10]],
			['attribute' => 'account_id', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 10]],
			['attribute' => 'cancellation_policy_id', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 10]],
			['attribute' => 'days', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 5]],
			['attribute' => 'rate', 'type' => DetailView::INPUT_SPIN],
			['attribute' => 'base_fee', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 7]],
		]
	]);	?>

</div>
