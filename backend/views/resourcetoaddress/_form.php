<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\ResourceToAddress $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="resource-to-address-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Resource')],
			['attribute' => 'address_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Address')],
		]
	]);	?>

</div>
