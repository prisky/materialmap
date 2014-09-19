<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\SummaryToPercentPromotion $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="summary-to-percent-promotion-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'percent_promotion_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('PercentPromotion', ['account_id' => $model->account_id])],
		]
	]);	?>

</div>
