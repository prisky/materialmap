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
//			['attribute' => 'annual_charge', 'type' => DetailView::INPUT_MONEY],
			['attribute' => 'annual_charge', 'type' => DetailView::INPUT_WIDGET,
				'options' => ['name' => 'test'],
				'widgetOptions' => [
					'class' => '\dosamigos\fileupload\FileUploadUIARA',
					'model' => $model,
//					'attribute' => 'annual_charge',
					'name' => 'annual_charge[]',	// html name attribute for the file input button - needed if no attribute, otherwise derived from attribute
					'url' => [				// controller action url
						strtolower($model->formName()) . '/upload',
						'id' => $model->id,
						'a' => 'annual_charge'
					],						
					'fieldOptions' => [],	// html options the file input field
					'options' => [],		// html options for the form
					'clientOptions' => [],	// jquery-file-upload plugin options - https://github.com/blueimp/jQuery-File-Upload/wiki/Options
				],
			],
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
