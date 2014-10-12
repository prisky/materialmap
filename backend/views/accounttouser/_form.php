<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\AccountToUser $model
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
            ['attribute' => 'user_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('User', [])
            ],
            ['attribute' => 'rate', 'type' => DetailView::INPUT_SPIN
            ],
            ['attribute' => 'newsletter', 'type' => DetailView::INPUT_SWITCH
            ],
            ['attribute' => 'immediate', 'type' => DetailView::INPUT_SWITCH
            ],
		]
	]);	?>

</div>
