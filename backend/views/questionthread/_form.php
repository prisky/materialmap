<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\QuestionThread $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="question-thread-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'comment', 'type' => DetailView::INPUT_TEXTAREA],
		]
	]);	?>

</div>
