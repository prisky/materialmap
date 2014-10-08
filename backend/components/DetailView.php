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
		'class'=>"overflow-hidden",
	];
    /**
     * @var array https://github.com/blueimp/jQuery-File-Upload/wiki/Options
     * If null then no model level files will be attachable. Setting this to [] will give model level uploads with dwfault options
     */
	public $uploadOptions;
	
	/**
	 * @inheritdoc
	 */
	public function init()
	{
		$this->formOptions['action'] = Url::to([
			$this->model->id ? 'update' : 'create',
			'id' => $this->model->id,
			Yii::$app->controller->parentParam
		]);
		$this->formOptions['id'] = $this->model->formName() . '-form';
		$this->formOptions['options']['enctype'] = 'multipart/form-data';
		
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
			$output .= Html::submitButton('Save', [
				'id' => 'activFormSave',
				'class' => 'btn btn-primary' . (is_null($this->uploadOptions) ? '' : ' hide')]);
		}

		// if there is errors but not specific attribute errors - may be trigger related
		if(isset($this->model->saveErrors)) {
			$output = Html::tag(
				'div',
				Html::listGroup($this->model->saveErrors, ['class' => "list-group"], 'ul', 'li class="list-group-item list-group-item-danger"'),
				['id' => 'nonattributeerrors']
			) . $output;
		}
		else {
			$output = Html::tag('div', '',['id' => 'nonattributeerrors']) . $output;
		}

		echo $output;

		echo \dosamigos\fileupload\FileUploadUIAR::widget([
			'model' => $this->model,
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