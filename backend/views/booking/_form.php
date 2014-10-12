<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Booking $model
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
            ['attribute' => 'summary_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Summary', ['account_id' => $model->account_id])
            ],
            ['attribute' => 'status', 'type' => DetailView::INPUT_DROPDOWN_LIST,
					'options' => ['prompt' => ''],
					'items' => [ "processing" => "Processing", "booked" => "Booked", "canceled" => "Canceled", "wait_listed" => "Wait listed" ]
            ],
		]
	]);	?>

</div>
