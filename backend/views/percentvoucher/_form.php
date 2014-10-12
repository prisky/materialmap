<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\PercentVoucher $model
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
            ['attribute' => 'rate', 'type' => DetailView::INPUT_SPIN],
        ],
    ]);?>
</div>
