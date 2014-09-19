<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\FieldSetToCustomField $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="field-set-to-custom-field-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'custom_field_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('CustomField', ['account_id' => $model->account_id])],
		]
	]);	?>

</div>
