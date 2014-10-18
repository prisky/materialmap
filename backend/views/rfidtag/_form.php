<?php

use backend\components\DetailView;

//haydens shit
//$this->registerJsFile('http://maps.google.com/maps/api/js?v=3&sensor=false');
$this->registerJsFile('https://maps.googleapis.com/maps/api/js?v=3.exp');
$this->registerJs(";initMap('$lat', '$long', '<b>$name</b><br/>')");
$this->title = $this->context->label($model->id);

/**
 * @var yii\web\View $this
 * @var common\models\RfidTag $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<div class="update">

    <h1><?= \yii\helpers\Html::encode($this->title) ?></h1>
 
    <div id="form-container">
        <div id="map">
        </div>
        <?= DetailView::widget([
            'model'=>$model,
            'condensed'=>true,
            'hover'=>true,
            'mode'=>$mode,
            'attributes'=>[
                ['attribute' => 'activation', 'type' => DetailView::INPUT_DROPDOWN_LIST,
                    'options' => ['prompt' => ''],
                    'items' => [ "Active" => "Active", "Inactive" => "Inactive" ]],
                ['attribute' => 'name_plate', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 255], 'options' => ['data-focus' => 'data-focus']],
                ['attribute' => 'commodity_code', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 255], 'options' => ['data-focus' => 'data-focus']],
                ['attribute' => 'latitude', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 255], 'options' => ['data-focus' => 'data-focus']],
                ['attribute' => 'longitude', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 255], 'options' => ['data-focus' => 'data-focus']],
            ],
        ]);?>
    </div>
</div>
