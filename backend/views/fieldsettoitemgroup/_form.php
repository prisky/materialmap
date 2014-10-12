<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\FieldSetToItemGroup $model
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
            ['attribute' => 'item_group_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('ItemGroup', ['account_id' => $model->account_id])
            ],
		]
	]);	?>

</div>
