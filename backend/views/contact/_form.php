<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Contact $model
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
            ['attribute' => 'first_name', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 64], 'options' => ['data-focus' => 'data-focus']],
            ['attribute' => 'last_name', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 64], 'options' => ['data-focus' => 'data-focus']],
            ['attribute' => 'email', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 255], 'options' => ['data-focus' => 'data-focus']],
            ['attribute' => 'phone_mobile', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 20], 'options' => ['data-focus' => 'data-focus']],
            ['attribute' => 'town_city_id', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 10], 'options' => ['data-focus' => 'data-focus']],
            ['attribute' => 'post_code', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 16], 'options' => ['data-focus' => 'data-focus']],
            ['attribute' => 'address_line1', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 255], 'options' => ['data-focus' => 'data-focus']],
            ['attribute' => 'address_line2', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 255], 'options' => ['data-focus' => 'data-focus']],
        ],
    ]);?>
</div>
