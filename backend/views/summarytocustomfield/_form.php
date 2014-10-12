<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\SummaryToCustomField $model
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
            ['attribute' => 'custom_value', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 255]
            ],
		]
	]);	?>

</div>
