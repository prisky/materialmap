<?php

namespace backend\components;

use kartik\helpers\Html;
use yii\helpers\ArrayHelper;

/* 
 * Copyright Andrew Blake 2014.
 */

class FieldRange extends \kartik\field\FieldRange
{
	// need to add dummy attribute for use in Controller::getGridColumns becuase of Object setter
	public $attribute;
	
	protected function renderWidget()
    {
        if ($this->type === self::INPUT_DATE) {
            $widget = $this->getDatePicker();
        } else {
            Html::addCssClass($this->container, 'form-group');
            Html::addCssClass($this->options, 'input-group');
            $widget = isset($this->form) ? $this->getFormInput() : $this->getInput(1) . $this->getInput(2);
 //           $widget = Html::tag('div', $widget, $this->options);
        }
        $widget = Html::tag('div', $widget, $this->widgetContainer);
        $error = Html::tag('div', '<div class="help-block"></div>', $this->errorContainer);

        echo Html::tag('div', strtr($this->template, [
            '{label}' => '',
            '{widget}' => $widget,
            '{error}' => $error
        ]), $this->container);
    }

    protected function getDatePicker()
    {
        $class = 'backend\components\DatePicker';
        $this->widgetOptions1['type'] = $class::TYPE_RANGE;
		
        if ($this->hasModel()) {
            $this->widgetOptions1 = ArrayHelper::merge($this->widgetOptions1, [
                'model' => $this->model,
                'attribute' => $this->attribute1,
                'attribute2' => $this->attribute2,
                'options' => $this->options,
                'options2' => $this->options2,
            ]);
        } else {
            $this->widgetOptions1 = ArrayHelper::merge($this->widgetOptions1, [
                'name' => $this->name1,
                'name2' => $this->name2,
                'value' => isset($this->value1) ? $this->value1 : null,
                'value2' => isset($this->value2) ? $this->value2 : null,
                'options' => $this->options1,
                'options2' => $this->options2,
            ]);
        }
        if (isset($this->form)) {
            $this->widgetOptions1['form'] = $this->form;
        }
        return $class::widget($this->widgetOptions1);
    }
	
	
}

