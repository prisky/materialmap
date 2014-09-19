<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\ItemInventory $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="item-inventory-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'quantity', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 6]],
			['attribute' => 'received', 'type' => DetailView::INPUT_DATETIME],
		]
	]);	?>

</div>
