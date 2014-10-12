<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Reseller $model
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
            ['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account', [])
            ],
            ['attribute' => 'trial_days', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 5]
            ],
            ['attribute' => 'expiry_days', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 5]
            ],
            ['attribute' => 'rate', 'type' => DetailView::INPUT_SPIN
            ],
            ['attribute' => 'child_admin', 'type' => DetailView::INPUT_SWITCH
            ],
		]
	]);	?>

</div>
