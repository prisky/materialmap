<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Column $model
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
            ['attribute' => 'label', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
            ['attribute' => 'help_html', 'type' => DetailView::INPUT_WIDGET, 'widgetOptions' => ['class' => 'common\components\HtmlEditor'],],
        ],
    ]);?>
</div>
