<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\AccountToAffiliateCategory $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="account-to-affiliate-category-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'affiliate_category_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('AffiliateCategory', ['account_id' => $model->account_id])],
			['attribute' => 'rate', 'type' => DetailView::INPUT_SPIN],
		]
	]);	?>

</div>
