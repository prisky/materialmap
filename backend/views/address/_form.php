<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Address $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="address-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'town_city_id', 'type' =>  DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('TownCity')],
			['attribute' => 'address_line1', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 255]],
			['attribute' => 'address_line2', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 255]],
			['attribute' => 'post_code', 'type' =>  DetailView::INPUT_TEXT, 'options' => ['maxlength' => 16]],
		]
	]);	?>

</div>
