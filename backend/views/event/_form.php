<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Event $model
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
            ['attribute' => 'event_type_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('EventType', ['account_id' => $model->account_id])
            ],
            ['attribute' => 'resource_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Resource', ['account_id' => $model->account_id])
            ],
            ['attribute' => 'start', 'type' => DetailView::INPUT_DATETIME
            ],
            ['attribute' => 'end', 'type' => DetailView::INPUT_DATETIME
            ],
            ['attribute' => 'status', 'type' => DetailView::INPUT_DROPDOWN_LIST,
					'options' => ['prompt' => ''],
					'items' => [ "confirmed" => "Confirmed", "canceled" => "Canceled", "awaiting_mimimum" => "Awaiting mimimum" ]
            ],
		]
	]);	?>

</div>
