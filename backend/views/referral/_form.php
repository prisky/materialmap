<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Referral $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="referral-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_to_user_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('AccountToUser', ['account_id' => $model->account_id])],
			['attribute' => 'invoice_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Invoice', ['account_to_user_id' => $model->account_to_user_id])],
			['attribute' => 'rate', 'type' => DetailView::INPUT_SPIN],
			['attribute' => 'summary_to_account_to_user_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('SummaryToAccountToUser', ['user_id' => $model->first_referrer_user_id])],
		]
	]);	?>

</div>
