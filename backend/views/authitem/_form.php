<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\AuthItem $model
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
            ['attribute' => 'name', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 64]],
            ['attribute' => 'type', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 11]],
            ['attribute' => 'data', 'type' => DetailView::INPUT_TEXTAREA, 'options' => ['data-focus' => 'data-focus']],
            ['attribute' => 'rule_name', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 64]],
            ['attribute' => 'description', 'type' => DetailView::INPUT_TEXTAREA, 'options' => ['data-focus' => 'data-focus']],
            ['attribute' => 'created_at', 'type' => DetailView::INPUT_DATETIME],
            ['attribute' => 'updated_at', 'type' => DetailView::INPUT_DATETIME],
        ],
    ]);?>
</div>
