<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Agency $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="agency-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account')],
			['attribute' => 'supplier_account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account')],
		]
	]);	?>

</div>
