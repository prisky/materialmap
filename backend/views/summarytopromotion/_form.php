<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\SummaryToPromotion $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="summary-to-promotion-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Summary')],
			['attribute' => 'promotion_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Promotion')],
		]
	]);	?>

</div>
