<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * ModelTreeController implements the CRUD actions for ModelTree model.
 */
class ModelTreeController extends \backend\components\Controller
{

	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
		"depth" => "#"
	];

	/**
	 * @inheritdoc
	 */
	public function getGridColumns()
	{
		return [
			[
				"attribute" => "child",
				"filterType" => "\\kartik\\widgets\\Select2",
				"filterWidgetOptions" => Controller::fKWidgetOptions('Model'),
				"value" => function ($model, $key, $index, $widget)
				{
					// if null foreign key
					if(!$model->model)
					{
						return;
					}
					elseif(Yii::$app->user->can($model->modelNameShort))
					{
						return Html::a($model->model->label, Url::toRoute([strtolower('Model') . "/update", "id" => $key]));
					}
					elseif(Yii::$app->user->can($model->modelNameShort . "Read"))
					{
						return Html::a($model->model->label, Url::toRoute([strtolower('Model') . "/read", "id" => $key]));
					}
					else
					{
						return $model->label($key);
					}
				},
					"format" => "raw"
			],
			[
				"attribute" => "depth",
				"filterType" => "backend\\components\\FieldRange",
				"filterWidgetOptions" => [
					"separator" => NULL,
					"attribute1" => "from_depth",
					"attribute2" => "to_depth"
				]
			],
			[
				"attribute" => "parent",
				"filterType" => "\\kartik\\widgets\\Select2",
				"filterWidgetOptions" => Controller::fKWidgetOptions('Model'),
				"value" => function ($model, $key, $index, $widget) {
					// if null foreign key
					if(!$model->model)
					{
						return;
					}
					elseif(Yii::$app->user->can($model->modelNameShort))
					{
						return Html::a($model->model->label, Url::toRoute([strtolower('Model') . "/update", "id" => $key]));
					}
					elseif(Yii::$app->user->can($model->modelNameShort . "Read"))
					{
						return Html::a($model->model->label, Url::toRoute([strtolower('Model') . "/read", "id" => $key]));
					}
					else
					{
						return $model->label($key);
					}
				},
				"format" => "raw"
			]
		];
	}

}
		