<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\SummaryToVoucher $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="summary-to-voucher-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Summary')],
			['attribute' => 'voucher_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Voucher')],
			['attribute' => 'amount', 'type' =>  DetailView::INPUT_MONEY],
		]
	]);	?>

</div>
