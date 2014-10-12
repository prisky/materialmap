<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Referral $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<div id="form-container">
    <?= DetailView::widget([
        'model'=>$model,
        'condensed'=>true,
        'hover'=>true,
        'mode'=>$mode,
        'attributes'=>[
            ['attribute' => 'summary_to_account_to_user_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('SummaryToAccountToUser', ['user_id' => $model->first_referrer_user_id])],
            ['attribute' => 'account_to_user_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('AccountToUser', ['account_id' => $model->account_id])],
            ['attribute' => 'invoice_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Invoice', ['account_to_user_id' => $model->account_to_user_id])],
            ['attribute' => 'rate', 'type' => DetailView::INPUT_SPIN],
        ],
    ]);?>
</div>
