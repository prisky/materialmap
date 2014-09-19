<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Newsletter $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="newsletter-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'content', 'type' => DetailView::INPUT_TEXTAREA],
			['attribute' => 'sent', 'type' => DetailView::INPUT_DATETIME],
			['attribute' => 'subject', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 255]],
		]
	]);	?>

</div>
