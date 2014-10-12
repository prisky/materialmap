<?php

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\CustomField $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div id="form-container">

    <?= DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
            ['attribute' => 'account_id', 'type' => DetailView::INPUT_SELECT2, 'widgetOptions' => $this->context->fKWidgetOptions('Account', [])
            ],
            ['attribute' => 'label', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 64]
            ],
            ['attribute' => 'allow_new', 'type' => DetailView::INPUT_SWITCH
            ],
            ['attribute' => 'validation_type', 'type' => DetailView::INPUT_DROPDOWN_LIST,
					'options' => ['prompt' => ''],
					'items' => [ "None" => "None", "PCRE" => "PCRE", "Range" => "Range", "Value list" => "Value list" ]
            ],
            ['attribute' => 'data_type', 'type' => DetailView::INPUT_DROPDOWN_LIST,
					'options' => ['prompt' => ''],
					'items' => [ "Date" => "Date", "Float" => "Float", "Int" => "Int", "Text" => "Text", "Time" => "Time" ]
            ],
            ['attribute' => 'mandatory', 'type' => DetailView::INPUT_SWITCH
            ],
            ['attribute' => 'comment', 'type' => DetailView::INPUT_TEXT, 'options' => ['maxlength' => 255]
            ],
            ['attribute' => 'validation_text', 'type' => DetailView::INPUT_TEXTAREA
            ],
            ['attribute' => 'validation_error', 'type' => DetailView::INPUT_TEXTAREA
            ],
		]
	]);	?>

</div>
