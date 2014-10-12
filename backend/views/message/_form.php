<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Message $model
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
            ['attribute' => 'name', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 255]],
            ['attribute' => 'system', 'type' => DetailView::INPUT_SWITCH],
            ['attribute' => 'email_html', 'type' => DetailView::INPUT_WIDGET, 'widgetOptions' => ['class' => 'common\components\HtmlEditor'],],
            ['attribute' => 'email_subject', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 100]],
            ['attribute' => 'sms_text', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 140]],
        ],
    ]);?>
</div>
