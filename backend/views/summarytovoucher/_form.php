<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\SummaryToVoucher $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="summary-to-voucher-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'amount', 'type' => DetailView::INPUT_MONEY],
			['attribute' => 'voucher_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Voucher', ['account_id' => $model->account_id])],
		]
	]);	?>

</div>
