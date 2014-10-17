<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
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
            ['attribute' => 'contact_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Contact', [])],
            ['attribute' => 'auth_key', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 32], 'options' => ['data-focus' => 'data-focus']],
            ['attribute' => 'password_hash', 'type' => DetailView::INPUT_PASSWORD, 'options' => ['data-focus' => 'data-focus']],
            ['attribute' => 'password_reset_token', 'type' => DetailView::INPUT_PASSWORD, 'options' => ['data-focus' => 'data-focus']],
        ],
    ]);?>
</div>
