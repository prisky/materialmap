<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\SummaryToCharge $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="summary-to-charge-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'charge_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Charge', ['account_id' => $model->account_id])],
		]
	]);	?>

</div>
