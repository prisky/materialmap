<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Navigation $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="navigation-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'parent', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Model')],
			['attribute' => 'child', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Model')],
			['attribute' => 'depth', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 11]],
		]
	]);	?>

</div>
