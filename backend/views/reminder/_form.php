<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Reminder $model
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
            ['attribute' => 'hours_prior', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 6]
            ],
		]
	]);	?>

</div>
