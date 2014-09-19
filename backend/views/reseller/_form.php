<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Reseller $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="reseller-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'child_admin', 'type' => DetailView::INPUT_SWITCH],
			['attribute' => 'expiry_days', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 5]],
			['attribute' => 'rate', 'type' => DetailView::INPUT_SPIN],
			['attribute' => 'trial_days', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 5]],
		]
	]);	?>

</div>
