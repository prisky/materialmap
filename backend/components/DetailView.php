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
	public $formOptions = [
		'beforeSubmit' => 'submitForm',
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
		
		// this starts the active form
		parent::init();
		
		// place hidden field to parent if not root
		foreach($parentParam as $parentForeignKeyName => $value) {
			$this->model->$parentForeignKeyName = $value;
			echo Html::activeHiddenInput($this->model, $parentForeignKeyName);
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
			$output .= Html::submitButton('Save', ['class' => 'btn btn-success']);
		}

		// if there is errors but not specific attribute errors - maybe trigger related
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

        \yii\widgets\ActiveForm::end();
    }
}