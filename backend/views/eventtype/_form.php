<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\EventType $model
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
            ['attribute' => 'name', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
            ['attribute' => 'seats_max', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 5]],
            ['attribute' => 'deposit', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 6]],
            ['attribute' => 'deposit_hours', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 5]],
            ['attribute' => 'seats_min', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 5]],
            ['attribute' => 'seats_min_hours', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 5]],
            ['attribute' => 'private_note', 'type' => DetailView::INPUT_TEXTAREA],
            ['attribute' => 'tooltip', 'type' => DetailView::INPUT_TEXTAREA],
        ],
    ]);?>
</div>
