<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\EventToResourceToCustomField $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="event-to-resource-to-custom-field-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Event')],
			['attribute' => 'resource_to_custom_field_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('ResourceToCustomField')],
		]
	]);	?>

</div>
