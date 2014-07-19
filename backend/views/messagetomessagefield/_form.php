<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\MessageToMessageField $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="message-to-message-field-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'message_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Message')],
			['attribute' => 'message_field_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('MessageField')],
		]
	]);	?>

</div>
