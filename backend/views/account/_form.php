<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Account $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="form-container">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'uploadOptions'=>['limitMultiFileUploads'=>null],
		'attributes'=>[
			['attribute' => 'annual_charge', 'type' => DetailView::INPUT_MONEY],
/*			['attribute' => 'annual_charge', 'type' => DetailView::INPUT_WIDGET,
				'widgetOptions' => [
					'class' => '\dosamigos\fileupload\FileUploadUIAR',
					'name' => $model->formName() . '[]',
					'url' => [strtolower($model->formName()) . '/upload', 'id' => $model->id, 'a' => 'annual_charge'],
					'gallery' => false,
					'fieldOptions' => [
						'accept' => 'image/*',
					],
					'options' => [
						'id' => $model->formName(),	// the form id
					],
					'clientOptions' => ['maxFileSize' => 2000000],
				],
			],*/
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

</div>
