<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\FieldSetTree $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="field-set-tree-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account')],
			['attribute' => 'child_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('FieldSet')],
			['attribute' => 'depth', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 11]],
		]
	]);	?>

</div>
