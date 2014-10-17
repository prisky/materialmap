<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\AuthItemChild $model
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
            ['attribute' => 'id', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 10], 'options' => ['data-focus' => 'data-focus']],
            ['attribute' => 'child', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 64], 'options' => ['data-focus' => 'data-focus']],
        ],
    ]);?>
</div>
