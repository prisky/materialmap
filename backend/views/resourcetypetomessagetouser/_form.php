<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\ResourceTypeToMessageToUser $model
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
            ['attribute' => 'user_id', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 10]
            ],
		]
	]);	?>

</div>
