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
     * @var array https://github.com/blueimp/jQuery-File-Upload/wiki/Options
     * If empty then no model level files will be attachable. 'limitMultiFileUploads'=>null will allow unlimited uploads
	 * defaults are:
	 * 'maxFileSize' => 2000000
     */
	public $uploadOptions = [];
	/**
	 * @inheritdoc
	 */
	public function init()
	{
		$params[] = $this->model->id ? 'update' : 'create';
		$params['id'] = $this->model->id;
		$parentParam = Yii::$app->controller->parentParam;
		$this->formOptions['action'] = Url::to(array_merge($params, $parentParam));
		$this->formOptions['id'] = $this->model->formName();
		$this->formOptions['options']['enctype'] = 'multipart/form-data';
		
		// this starts the active form
		parent::init();

// TODO: is this needed now?
//		// place hidden field to parent if not root
//		foreach($parentParam as $parentAttribute => $value) {
//			$this->model->$parentAttribute = $value;
//			echo Html::activeHiddenInput($this->model, $parentAttribute);
//		}
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
			$output .= Html::submitButton('Save', ['id' => 'activeFromSave', 'class' => 'btn btn-primary' . ($this->uploadOptions ? ' hide' : '')]);
		}

		// if there is errors but not specific attribute errors - may be trigger related
		$errors = $this->model->errors;
		if(isset($errors[null])) {
			foreach($errors as $error) {
				$items[] = ['content' => $error[0]];
			}
			
			$output = Html::tag(
				'div',
				Html::listGroup($items, ['class' => "list-group"], 'ul', 'li class="list-group-item list-group-item-danger"') . $output,
				['id' => 'nonattributeerrors']
			);
		}
		else {
			$output = Html::tag('div', '',['id' => 'nonattributeerrors']) . $output;
		}

		echo $output;

		if($this->uploadOptions) {
			$this->uploadOptions += [
				'maxFileSize' => 2000000,
			];
			echo \dosamigos\fileupload\FileUploadUIAR::widget([
				'name' => 'files',
				'url' => [strtolower($this->model->formName()) . '/upload', 'id' => $this->model->id],
				'gallery' => false,
				'fieldOptions' => [
					'accept' => 'image/*',
				],
				'options' => [
					'id' => $this->model->formName(),	// the form id
				],
				'clientOptions' => $this->uploadOptions,
			]);
		}

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