<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\ResourceToCustomField $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="resource-to-custom-field-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Resource')],
			['attribute' => 'custom_field_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('CustomField')],
		]
	]);	?>

</div>
