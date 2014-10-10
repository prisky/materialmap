<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\CancellationPolicy $model
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
            ['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account', [])],
            ['attribute' => 'begin', 'type' => DetailView::INPUT_DATETIME],
            ['attribute' => 'finish', 'type' => DetailView::INPUT_DATETIME],
            ['attribute' => 'days', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 6]],
            ['attribute' => 'rate', 'type' => DetailView::INPUT_SPIN],
            ['attribute' => 'base_fee', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 7]],
		]
	]);	?>

</div>
