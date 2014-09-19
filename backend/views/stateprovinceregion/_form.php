<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\StateProvinceRegion $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="state-province-region-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'country_id', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 5]],
			['attribute' => 'name', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
		]
	]);	?>

</div>
