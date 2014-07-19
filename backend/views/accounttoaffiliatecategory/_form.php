<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\AccountToAffiliateCategory $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="account-to-affiliate-category-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account')],
			['attribute' => 'affiliate_category_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('AffiliateCategory')],
			['attribute' => 'rate', 'type' => DetailView::INPUT_SPIN],
		]
	]);	?>

</div>
