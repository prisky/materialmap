<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\SurveyToCustomField $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="survey-to-custom-field-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Survey')],
			['attribute' => 'custom_field_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('CustomField')],
			['attribute' => 'order', 'type' =>  DetailView::INPUT_TEXT],
		]
	]);	?>

</div>
