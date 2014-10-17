<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\RfidTag $model
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
            ['attribute' => 'activation', 'type' => DetailView::INPUT_DROPDOWN_LIST,
                'options' => ['prompt' => ''],
                'items' => [ "Active" => "Active", "Inactive" => "Inactive" ]],
            ['attribute' => 'name_plate', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 255], 'options' => ['data-focus' => 'data-focus']],
            ['attribute' => 'commodity_code', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 255], 'options' => ['data-focus' => 'data-focus']],
        ],
    ]);?>
</div>
