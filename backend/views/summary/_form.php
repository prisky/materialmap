<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Summary $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="summary-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'contact_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Contact', [])],
		]
	]);	?>

</div>
