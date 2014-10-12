<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\StandardSetup $model
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
            ['attribute' => 'reseller_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Reseller', [])
            ],
		]
	]);	?>

</div>
