<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\SummaryToPercentVoucher $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="summary-to-percent-voucher-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'percent_voucher_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('PercentVoucher', ['account_id' => $model->account_id])],
		]
	]);	?>

</div>
