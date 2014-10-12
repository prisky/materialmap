<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\QuestionThread $model
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
            ['attribute' => 'comment_html_basic', 'type' => DetailView::INPUT_WIDGET, 'widgetOptions' => ['class' => 'common\components\HtmlEditorBasic'],
            ],
		]
	]);	?>

</div>
