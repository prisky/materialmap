<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Reader $model
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
            ['attribute' => 'activation', 'type' => DetailView::INPUT_DROPDOWN_LIST,
                'options' => ['prompt' => ''],
                'items' => [ "Active" => "Active", "Inactive" => "Inactive" ]],
        ],
    ]);?>
</div>
