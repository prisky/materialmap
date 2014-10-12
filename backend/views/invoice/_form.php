<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Invoice $model
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
            ['attribute' => 'account_to_user_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('AccountToUser', [])],
            ['attribute' => 'invoiced', 'type' => DetailView::INPUT_DATETIME],
            ['attribute' => 'paid', 'type' => DetailView::INPUT_DATETIME],
        ],
    ]);?>
</div>
