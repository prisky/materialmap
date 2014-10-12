<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Question $model
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
            ['attribute' => 'comment_html_basic', 'type' => DetailView::INPUT_WIDGET, 'widgetOptions' => ['class' => 'common\components\HtmlEditorBasic'],],
            ['attribute' => 'offer', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 7]],
            ['attribute' => 'bid_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Bid', ['account_id' => $model->account_id])],
            ['attribute' => 'answer', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('QuestionThread', ['account_id' => $model->account_id])],
        ],
    ]);?>
</div>
