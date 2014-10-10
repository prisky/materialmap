<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Contact $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="form-container">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
            ['attribute' => 'first_name', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
            ['attribute' => 'last_name', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
            ['attribute' => 'email', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 255]],
            ['attribute' => 'phone_mobile', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 20]],
            ['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account', [])],
            ['attribute' => 'town_city_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('TownCity', [])],
            ['attribute' => 'post_code', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 16]],
            ['attribute' => 'address_line1', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 255]],
            ['attribute' => 'address_line2', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 255]],
            ['attribute' => 'verified', 'type' => DetailView::INPUT_DATETIME],
		]
	]);	?>

</div>
