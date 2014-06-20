<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\AffiliateCategory $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="affiliate-category-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'account_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account')],
			['attribute' => 'root', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 10]],
			['attribute' => 'lft', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 10]],
			['attribute' => 'rgt', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 10]],
			['attribute' => 'level', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 10]],
		]
	]);	?>

</div>
