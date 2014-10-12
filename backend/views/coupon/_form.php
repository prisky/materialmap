<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Coupon $model
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
            ['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account', [])],
            ['attribute' => 'reseller_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Reseller', ['account_id' => $model->account_id])],
            ['attribute' => 'uniqueid', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 13]],
            ['attribute' => 'expiry', 'type' => DetailView::INPUT_DATETIME],
        ],
    ]);?>
</div>
