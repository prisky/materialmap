<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\PercentPromotion $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="percent-promotion-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'rate', 'type' => DetailView::INPUT_SPIN],
		]
	]);	?>

</div>
