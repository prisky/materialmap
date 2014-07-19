<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\PercentVoucherConstraint $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="percent-voucher-constraint-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('PercentVoucher')],
			['attribute' => 'percent_voucher_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('PercentVoucher')],
			['attribute' => 'invalid_from', 'type' => DetailView::INPUT_DATETIME],
			['attribute' => 'invalaid_to', 'type' => DetailView::INPUT_DATETIME],
		]
	]);	?>

</div>
