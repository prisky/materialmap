<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\PercentPromotionConstraint $model
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
            ['attribute' => 'invalid_from', 'type' => DetailView::INPUT_DATETIME
            ],
            ['attribute' => 'invalid_to', 'type' => DetailView::INPUT_DATETIME
            ],
		]
	]);	?>

</div>
