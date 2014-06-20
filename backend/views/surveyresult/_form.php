<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\SurveyResult $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="survey-result-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('SurveyToCustomField')],
			['attribute' => 'survey_to_custom_field_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('SurveyToCustomField')],
			['attribute' => 'custom_value', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 255]],
		]
	]);	?>

</div>
