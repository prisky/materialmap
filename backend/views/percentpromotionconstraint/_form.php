<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\PercentPromotionConstraint $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="percent-promotion-constraint-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account')],
			['attribute' => 'invalid_from', 'type' => DetailView::INPUT_DATETIME],
			['attribute' => 'invalid_to', 'type' => DetailView::INPUT_DATETIME],
		]
	]);	?>

</div>
