<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Account $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="account-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'user_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('User')],
		]
	]);	?>

</div>
