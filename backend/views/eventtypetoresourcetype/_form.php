<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\EventTypeToResourceType $model
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
            ['attribute' => 'resource_type_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('ResourceType', ['account_id' => $model->account_id])
            ],
		]
	]);	?>

</div>
