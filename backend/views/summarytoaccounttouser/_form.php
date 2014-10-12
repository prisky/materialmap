<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\SummaryToAccountToUser $model
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
            ['attribute' => 'account_to_user_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('AccountToUser', ['user_id' => $model->user_id, 'account_id' => $model->account_id])],
            ['attribute' => 'invoice_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Invoice', ['account_to_user_id' => $model->account_to_user_id])],
            ['attribute' => 'rate', 'type' => DetailView::INPUT_SPIN],
        ],
    ]);?>
</div>
