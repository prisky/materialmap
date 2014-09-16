<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\FieldSetToItemGroup $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="field-set-to-item-group-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account')],
			['attribute' => 'item_group_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('ItemGroup')],
		]
	]);	?>

</div>
