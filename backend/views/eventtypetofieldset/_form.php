<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\EventTypeToFieldSet $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="event-type-to-field-set-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account')],
			['attribute' => 'field_set_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('FieldSet')],
		]
	]);	?>

</div>
