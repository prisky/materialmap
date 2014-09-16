<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\SummaryToItem $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="summary-to-item-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'summary_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Summary')],
			['attribute' => 'field_set_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('FieldSetToItemGroup')],
			['attribute' => 'item_group_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Item')],
			['attribute' => 'item_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Item')],
			['attribute' => 'quantity', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 5]],
			['attribute' => 'amount', 'type' => DetailView::INPUT_MONEY],
		]
	]);	?>

</div>
