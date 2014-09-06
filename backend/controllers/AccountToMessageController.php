<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * AccountToMessageController implements the CRUD actions for AccountToMessage model.
 */
class AccountToMessageController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [

    ];

	/**
	 * @inheritdoc
	 */
	public function getGridColumns() {
		return [
            [
                "attribute" => "email_message"
            ],
            [
                "attribute" => "email_subject"
            ],
            [
                "attribute" => "message_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Message'),
                "value" => function ($model, $key, $index, $widget) {
								// if null foreign key
								if(!$model->message) {
									return;
								}
								elseif(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->message->label, Url::toRoute([strtolower('Message') . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->message->label, Url::toRoute([strtolower('Message') . "/read", "id" => $key]));
								}
								else {
									return $model->label($key);
								}
							},
                "format" => "raw"
            ],
            [
                "attribute" => "sms_message"
            ]
        ];
	}

}