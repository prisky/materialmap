<?php

namespace backend\components;

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
	
		$fullModelName = $this->model->className();

		// if not a root node in navigation
		if($parentForeignKeyName = $fullModelName::getParentForeignKeyName()) {
			$this->model->$parentForeignKeyName = isset($_GET[$parentForeignKeyName]) ? $_GET[$parentForeignKeyName] : NULL;
			$params[$parentForeignKeyName] = $this->model->$parentForeignKeyName;
		}
		
		$this->formOptions['action'] = \yii\helpers\Url::toRoute($params);
		
		// this starts the active form
		parent::init();
		
		// place hidden field to parent if not root
		if($parentForeignKeyName) {
			echo \yii\helpers\Html::activeHiddenInput($this->model, $parentForeignKeyName);
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
			$output .= \yii\helpers\Html::submitButton('Save', ['class' => 'btn btn-success']);
		}
		
		echo $output;

        \yii\widgets\ActiveForm::end();
    }
}