<?php

namespace backend\components;

use kartik\helpers\Html;
use yii\helpers\Url;
use Yii;

/**
 * @inheritdoc
 */
class DetailView extends \kartik\detail\DetailView
{
	public $template = '<div class="modal-body row"><div class="col-xs-3">{label}</div><div class="col-xs-9">{value}</div></div>';
	public $options = [
		'tag'=>'div',
	];
	
	/**
	 * @inheritdoc
	 */
	public function init()
	{
		// if update
		if($this->model->id) {
			$params[] = 'update';
			$params['id'] = $this->model->id;
		}
		// otherwise create
		else {
			$params[] = 'create';
		}
		
		$parentParam = Yii::$app->controller->parentParam;
		$this->formOptions['action'] = Url::to(array_merge($params, $parentParam));
		$this->formOptions['id'] = $this->model->formName();
		$this->formOptions['options']['enctype'] = 'multipart/form-data';
		
		// this starts the active form
		parent::init();

// TODO: is this needed now?
		// place hidden field to parent if not root
		foreach($parentParam as $parentAttribute => $value) {
			$this->model->$parentAttribute = $value;
			echo Html::activeHiddenInput($this->model, $parentAttribute);
		}
	}

	/**
	 * @inheritdoc
	 */
    public function run()
    {
        $output = $this->renderDetailView();
        if (is_array($this->panel) && !empty($this->panel) && $this->panel !== false) {
            $output = $this->renderPanel($output);
        }
        $output = strtr($this->mainTemplate, [
            '{detail}' => '<div id="' . $this->container['id'] . '">' . $output . '</div>'
        ]);
        
		if($this->mode == static::MODE_EDIT) {
			$output .= Html::submitButton('Save', ['class' => 'btn btn-primary hide']);
		}

		// if there is errors but not specific attribute errors - may be trigger related
		$errors = $this->model->errors;
		if(isset($errors[null])) {
			foreach($errors as $error) {
				$items[] = ['content' => $error[0]];
			}
			
			$output = 
				Html::listGroup($items, ['class' => "list-group"], 'ul', 'li class="list-group-item list-group-item-danger"')
				. $output;
		}
	
		echo $output;

echo \dosamigos\fileupload\FileUploadUIAR::widget([
    'name' => 'files',
    'url' => ['account/upload', 'id' => 1],
    'gallery' => false,
    'fieldOptions' => [
            'accept' => 'image/*'
    ],
	'options' => [
		'id' => $this->model->formName(),
	],
    'clientOptions' => [
            'maxFileSize' => 2000000
    ]
]);
        \yii\widgets\ActiveForm::end();
		
		
		
$js = <<<JS
// get the form id and set the event
$('form#{$this->model->formName()}').on('beforeSubmit', function(e) {
	var form = $(this);
	$.post(
		form.attr("action"),
		form.serialize()
	)
	.done(function(result) {
		form.parent().html(result);
	})
	.fail(function() {
		console.log("server error");
	});
	return false;
}).on('submit', function(e){
    e.preventDefault();
});
JS;
$view = $this->getView();
$view->registerJs($js);

    }
}