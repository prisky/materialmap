<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Item $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="item-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'amount', 'type' => DetailView::INPUT_MONEY],
			['attribute' => 'name', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
		]
	]);	?>

</div>
