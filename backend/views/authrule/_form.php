<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\AuthRule $model
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
            ['attribute' => 'data', 'type' => DetailView::INPUT_TEXTAREA, 'options' => ['data-focus' => 'data-focus']],
            ['attribute' => 'created_at', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 11], 'options' => ['data-focus' => 'data-focus']],
            ['attribute' => 'updated_at', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 11], 'options' => ['data-focus' => 'data-focus']],
        ],
    ]);?>
</div>
