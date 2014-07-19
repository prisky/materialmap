<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\SurveyToResource $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="survey-to-resource-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Survey')],
			['attribute' => 'resource_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Resource')],
		]
	]);	?>

</div>
