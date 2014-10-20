<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\FileRule $model
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
            ['attribute' => 'column_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Column', ['auth_item_name' => $model->auth_item_name, 'name' => $model->column_name])],
            ['attribute' => 'validator', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 64]],
            ['attribute' => 'key', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 64]],
            ['attribute' => 'value', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 64]],
        ],
    ]);?>
</div>
