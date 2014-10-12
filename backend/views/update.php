<?php

/**
 * @var yii\web\View $this
 * @var common\models\Account $model
  */

$this->title = $this->context->label($model->id);
?>
<div class="update">

    <h1><?= \yii\helpers\Html::encode($this->title) ?></h1>

    <?= $this->render('//' . $this->context->id . '/_form', [
        'model' => $model,
        'mode' => \backend\components\DetailView::MODE_EDIT,
    ]) ?>
</div>
