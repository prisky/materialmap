<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Comment $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="comment-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'contact_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Contact', [])],
			['attribute' => 'content', 'type' => DetailView::INPUT_TEXTAREA],
		]
	]);	?>

</div>
