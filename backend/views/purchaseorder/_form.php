<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\PurchaseOrder $model
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
            ['attribute' => 'name', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 64], 'options' => ['data-focus' => 'data-focus']],
            ['attribute' => 'construction_work_pack', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 255], 'options' => ['data-focus' => 'data-focus']],
        ],
    ]);?>
</div>
