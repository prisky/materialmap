<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\PercentVoucherConstraint $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="percent-voucher-constraint-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'invalaid_to', 'type' => DetailView::INPUT_DATETIME],
			['attribute' => 'invalid_from', 'type' => DetailView::INPUT_DATETIME],
		]
	]);	?>

</div>
