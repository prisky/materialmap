<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Country $model
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
            ['attribute' => 'code', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 2]],
            ['attribute' => 'currency_code', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 3]],
            ['attribute' => 'currency_symbol', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 1]],
            ['attribute' => 'phone_prefix', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 6]],
            ['attribute' => 'tax_name', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 256]],
        ],
    ]);?>
</div>
