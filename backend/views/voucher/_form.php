<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Voucher $model
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
            ['attribute' => 'amount', 'type' => DetailView::INPUT_MONEY],
            ['attribute' => 'uniqueid', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 13]],
        ],
    ]);?>
</div>
