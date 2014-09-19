<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\PaypalSubCategory $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="paypal-sub-category-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'name', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
			['attribute' => 'paypal_category_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('PaypalCategory', [])],
		]
	]);	?>

</div>
