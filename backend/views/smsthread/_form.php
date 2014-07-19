<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\SmsThread $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="sms-thread-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
		]
	]);	?>

</div>
