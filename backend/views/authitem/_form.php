<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\AuthItem $model
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
            ['attribute' => 'type', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 11]],
            ['attribute' => 'data', 'type' => DetailView::INPUT_TEXTAREA],
            ['attribute' => 'rule_name', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
            ['attribute' => 'description', 'type' => DetailView::INPUT_TEXTAREA],
            ['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account', [])],
            ['attribute' => 'created_at', 'type' => DetailView::INPUT_DATETIME],
            ['attribute' => 'updated_at', 'type' => DetailView::INPUT_DATETIME],
		]
	]);	?>

</div>
