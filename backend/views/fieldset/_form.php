<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\FieldSet $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="field-set-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'level', 'type' => DetailView::INPUT_DROPDOWN_LIST,
				'options' => ['prompt' => ''],
				'items' => [ "Summary" => "Summary", "Booking" => "Booking", "Ticket" => "Ticket", "Ticket to seat" => "Ticket to seat" ]],
		]
	]);	?>

</div>
