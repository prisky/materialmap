<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Marker $model
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
            ['attribute' => 'latitude', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 255], 'options' => ['data-focus' => 'data-focus']],
            ['attribute' => 'longitude', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 255], 'options' => ['data-focus' => 'data-focus']],
        ],
    ]);?>
</div>
