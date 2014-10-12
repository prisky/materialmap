<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Newsletter $model
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
            ['attribute' => 'subject', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 255]
            ],
            ['attribute' => 'content_html', 'type' => DetailView::INPUT_WIDGET, 'widgetOptions' => ['class' => 'common\components\HtmlEditor'],
            ],
		]
	]);	?>

</div>
