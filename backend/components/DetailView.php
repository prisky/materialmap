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
        'tag' => 'div',
        'class' => "overflow-hidden",
    ];
    public $button;
    public $fadeDelay = 0;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->mode == static::MODE_EDIT) {
            $this->button = $this->button ? $this->button : Html::submitButton('Save', [
                    'id' => 'activFormSave',
                    'class' => 'btn btn-primary start',
            ]);
        } else {
            $this->button = '';
        }

        $this->formOptions['action'] = Url::to([
                $this->model->id ? 'update' : 'create',
                'id' => $this->model->id,
                Yii::$app->controller->parentParam
        ]);
        $this->formOptions['id'] = $this->model->formName() . '-form';
        $this->formOptions['options']['enctype'] = 'multipart/form-data';

        parent::init();
        
        // place hidden field to parent if not root
        foreach(Yii::$app->controller->parentParam as $parentAttribute => $value) {
            $this->model->$parentAttribute = $value;
            echo Html::activeHiddenInput($this->model, $parentAttribute);
        }
        
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        // if there is errors but not specific attribute errors - may be trigger related
        $output = isset($this->model->saveErrors) ? Html::tag(
                'di', Html::listGroup($this->model->saveErrors, ['class' => "list-group"], 'ul', 'li class="list-group-item list-group-item-danger"'
                ), ['id' => 'nonattributeerrors']) : Html::tag('div', '', ['id' => 'nonattributeerrors']);

        $output .= $this->renderDetailView();
        if (is_array($this->panel) && !empty($this->panel) && $this->panel !== false) {
            $output = $this->renderPanel($output);
        }
        $output = strtr($this->mainTemplate, [
            '{detail}' => '<div id="' . $this->container['id'] . '">' . $output . '</div>'
        ]);

        $output .= $this->button;

        echo $output;

        \yii\widgets\ActiveForm::end();

        $js = <<<JS
$('form#{$this->formOptions['id']}').on('beforeSubmit', function(e) {
    var form = $(this);
    $.post(
        form.attr("action"),
        form.serialize()
    )
    .done(function(result) {
        form.parent().html(result);
 console.log(2);
       $('input:not([class=\"hasDatepicker\"]):visible:enabled:first, textarea:first', this).first().focus();
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
