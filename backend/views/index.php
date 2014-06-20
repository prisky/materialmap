<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\models\AccountSearch $searchModel
 * @var yii\grid\SerialColumn $gridColumns
 */

$this->title = $this->context->labelPlural();
?>
<div class="index">

    <p>
	<?php Modal::begin([
		'id' => 'new',
		'header' => '<h4 class="modal-title">' . Html::encode(Yii::t('app', ' New') . ' ' . $this->context->label()) . '</h4>',
	]);?>
    </p>

	<div>

	<?= $this->render('//' . $this->context->id . '/_form', [
		'model' => new $this->context->modelName,
		'mode' => \backend\components\DetailView::MODE_EDIT,
	]) ?>

	</div>
	<?php Modal::end(); ?>

    <?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => $gridColumns,
		'responsive' => true,
		'hover' => true,
		'bordered' => false,
		'floatHeader'=>true,
//		'floatHeaderOptions'=>['scrollingTop'=>'50'], currently causing column names to dissapear
		'panel' => [
			'heading'=>Html::tag('h3', Html::encode($this->title), ['class' => 'panel-title']),
			'type'=>'default',
			'before'=>  \yii\bootstrap\Button::widget([
				'label' => '<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', ' New'),
				'options' => ['class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#new'],
				'encodeLabel' => false
			]),
			'showFooter'=>true
		],
	]); ?>
	
</div>
