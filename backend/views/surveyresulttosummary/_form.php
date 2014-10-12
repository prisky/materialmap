<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\SurveyResultToSummary $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="form-container">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
            ['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account', [])
            ],
            ['attribute' => 'summary_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Summary', ['account_id' => $model->account_id])
            ],
            ['attribute' => 'custom_field_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('CustomField', ['account_id' => $model->account_id])
            ],
            ['attribute' => 'custom_value', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 255]
            ],
		]
	]);	?>

</div>
