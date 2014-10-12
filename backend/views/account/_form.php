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
        'button' => $this->context->renderPartial('@vendor/2amigos/yii2-file-upload-widget/views/saveButtonBar.php'),
        'mode'=>$mode,
        'attributes'=>[
            ['attribute' => 'logo_image', 'type' => DetailView::INPUT_WIDGET, 
                "widgetOptions" => [
                    "class" => '\dosamigos\fileupload\FileUploadUIAR',
                    "model" => $model,
                ],],
            ['attribute' => 'user_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('User', [])],
            ['attribute' => 'phone_work', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 20]],
            ['attribute' => 'balance', 'type' => DetailView::INPUT_MONEY],
            ['attribute' => 'summary_charge', 'type' => DetailView::INPUT_MONEY],
            ['attribute' => 'booking_charge', 'type' => DetailView::INPUT_MONEY],
            ['attribute' => 'ticket_charge', 'type' => DetailView::INPUT_MONEY],
            ['attribute' => 'seat_charge', 'type' => DetailView::INPUT_MONEY],
            ['attribute' => 'sms_charge', 'type' => DetailView::INPUT_MONEY],
            ['attribute' => 'annual_charge', 'type' => DetailView::INPUT_MONEY],
            ['attribute' => 'rate', 'type' => DetailView::INPUT_SPIN],
            ['attribute' => 'optimisation', 'type' => DetailView::INPUT_DROPDOWN_LIST,
                'options' => ['prompt' => ''],
                'items' => [ "None" => "None", "Compress" => "Compress", "Spread" => "Spread" ]],
        ],
    ]);?>
</div>
