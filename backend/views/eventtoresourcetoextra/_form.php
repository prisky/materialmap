<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\EventToResourceToExtra $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="event-to-resource-to-extra-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Event')],
			['attribute' => 'resource_to_extra_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('ResourceToExtra')],
		]
	]);	?>

</div>
