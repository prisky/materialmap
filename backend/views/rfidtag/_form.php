<?php

use backend\components\DetailView;

//haydens shit
$this->registerJsFile('https://maps.googleapis.com/maps/api/js?v=3.exp');
if(!$model->isNewRecord) {
    $this->registerJs(";initMap('$lat', '$long', '<b>$name</b><br/>')");
    $this->title = $this->context->label($model->id);
}

/**
 * @var yii\web\View $this
 * @var common\models\RfidTag $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<div class="update">

    <h1><?= \yii\helpers\Html::encode($this->title) ?></h1>
 
    <div id="form-container">
<?php if(!$model->isNewRecord): ?>
        <div id="map">
        </div>
<?php endif; ?>
    <?= DetailView::widget([
        'model'=>$model,
        'condensed'=>true,
        'hover'=>true,
        'mode'=>$mode,
        'attributes'=>[
            ['attribute' => 'activation', 'type' => DetailView::INPUT_DROPDOWN_LIST,
                'options' => ['prompt' => ''],
                'items' => [ "Active" => "Active", "Inactive" => "Inactive" ]],
            ['attribute' => 'name_plate', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 255]],
            ['attribute' => 'commodity_code', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 255]],
            ['attribute' => 'latitude', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 255]],
            ['attribute' => 'longitude', 'type' => DetailView::INPUT_TEXT, 'options' => ['data-focus' => 'data-focus', 'maxlength' => 255]],
        ],
    ]);?>
    </div>
</div>
