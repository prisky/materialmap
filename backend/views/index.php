<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
//use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\models\AccountSearch $searchModel
 * @var yii\grid\SerialColumn $gridColumns
 */

$this->title = $this->context->labelPlural();

// alter action for exporet to use current params for filtering etc
$action = array_merge(['export'], Yii::$app->request->queryParams);
unset($action['r']);
Yii::$app->getModule('gridview')->downloadAction = $action;

$template = <<< HTML
<div class="panel {type}">
	<div class="panel-heading clearfix">
		<div class="pull-right kv-panel-pager">{pager}</div>
		<div class="pull-right">{summary}</div>
		{heading}
	</div>
	{before}
	{items}
	{after}
</div>
HTML;


?>
<div class="index">

	<?php Modal::begin([
		'id' => 'modal',
		'header' => '<h4 class="modal-title">' . Html::encode(Yii::t('app', ' New') . ' ' . $this->context->label()) . '</h4>',
	]);?>

	<div id='modalContent'></div>

	<?php Modal::end(); ?>
	
    <?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => $gridColumns,
		'responsive' => true,
		'hover' => true,
		'bordered' => false,
		'floatHeader' => true,
//		'floatHeaderOptions'=>['scrollingTop'=>'50'], currently causing column names to dissapear
		'panel' => [
			'heading'=>Html::tag('h3', Html::encode($this->title), ['class' => 'panel-title']),
			'type' => 'default',
			'before' => $before,
			'showFooter' => false,
			'layout' => $template,
		],
		'exportConfig' => [
			GridView::CSV => [],
			GridView::EXCEL => [],
		],
	]); ?>

	
</div>
