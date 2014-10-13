<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Bid $model
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
            ['attribute' => 'offer', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 7]],
            ['attribute' => 'comment_markdown', 'type' => DetailView::INPUT_TEXTAREA],
            ['attribute' => 'deadline', 'type' => DetailView::INPUT_DATETIME],
            ['attribute' => 'updated', 'type' => DetailView::INPUT_DATETIME],
        ],
    ]);?>
</div>
