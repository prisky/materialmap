<?php

use backend\components\DetailView;
use dosamigos\fileupload\FileUploadUI;

/**
 * @var yii\web\View $this
 * @var common\models\Account $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="account-form">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
			['attribute' => 'annual_charge', 'type' => DetailView::INPUT_MONEY],
			['attribute' => 'balance', 'type' => DetailView::INPUT_MONEY],
			['attribute' => 'booking_charge', 'type' => DetailView::INPUT_MONEY],
			['attribute' => 'optimisation', 'type' => DetailView::INPUT_DROPDOWN_LIST,
				'options' => ['prompt' => ''],
				'items' => [ "None" => "None", "Compress" => "Compress", "Spread" => "Spread" ]],
			['attribute' => 'phone_work', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 20]],
			['attribute' => 'rate', 'type' => DetailView::INPUT_SPIN],
			['attribute' => 'seat_charge', 'type' => DetailView::INPUT_MONEY],
			['attribute' => 'sms_charge', 'type' => DetailView::INPUT_MONEY],
			['attribute' => 'summary_charge', 'type' => DetailView::INPUT_MONEY],
			['attribute' => 'ticket_charge', 'type' => DetailView::INPUT_MONEY],
			['attribute' => 'user_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('User', [])],
		]
	]);	?>

<?= FileUploadUI::widget([
    'model' => $model,
    'attribute' => 'phone_work',
    'url' => ['account/upload', 'id' => 1],
    'gallery' => false,
    'fieldOptions' => [
            'accept' => 'image/*'
    ],
    'clientOptions' => [
            'maxFileSize' => 2000000
    ]
]);
?>
</div>
