<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\ModelTree $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="model-tree-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'parent', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Model')],
			['attribute' => 'child', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Model')],
		]
	]);	?>

</div>
