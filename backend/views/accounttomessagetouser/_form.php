<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\AccountToMessageToUser $model
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
            ['attribute' => 'account_to_message', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('AccountToMessage', ['account_id' => $model->account_id])
            ],
            ['attribute' => 'user_id', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 10]
            ],
		]
	]);	?>

</div>
