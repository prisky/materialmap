<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\EventTypeToResourceTypeToExtra $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="event-type-to-resource-type-to-extra-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('EventType')],
			['attribute' => 'event_type_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('EventType')],
			['attribute' => 'resource_type_to_extra_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('ResourceTypeToExtra')],
		]
	]);	?>

</div>
