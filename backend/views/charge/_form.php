<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Charge $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="charge-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'amount', 'type' => DetailView::INPUT_MONEY],
		]
	]);	?>

</div>
