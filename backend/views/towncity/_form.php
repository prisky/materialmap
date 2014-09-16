<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\TownCity $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="town-city-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'name', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]],
			['attribute' => 'state_province_region', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('StateProvinceRegion')],
		]
	]);	?>

</div>
