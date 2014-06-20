<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Summary $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="summary-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account')],
		]
	]);	?>

</div>
