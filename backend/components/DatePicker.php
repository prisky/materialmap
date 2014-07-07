<?php

/* 
 * Copyright Andrew Blake 2014.
 */

namespace backend\components;

use kartik\helpers\Html;

class DatePicker extends \kartik\widgets\DatePicker
{
    private $_container = [];
    public $separator = null;

    /**
     * Parses the input to render based on markup type
     *
     * @param string $input
     * @return string
     */
    protected function parseMarkup($input)
	{
        if ($this->type == self::TYPE_INPUT || $this->type == self::TYPE_INLINE) {
            if (isset($this->size)) {
                Html::addCssClass($this->options, 'input-' . $this->size);
            }
        } elseif (isset($this->size)) {
            Html::addCssClass($this->_container, 'input-group input-group-' . $this->size);
        } else {
            Html::addCssClass($this->_container, 'input-group');
        }
        if ($this->type == self::TYPE_INPUT) {
            return $input;
        }
        if ($this->type == self::TYPE_COMPONENT_PREPEND) {
            Html::addCssClass($this->_container, 'date');
            return Html::tag('div', "<span class='input-group-addon'>{$this->addon}</span>{$input}", $this->_container);
        }
        if ($this->type == self::TYPE_COMPONENT_APPEND) {
            Html::addCssClass($this->_container, 'date');
            return Html::tag('div', "{$input}<span class='input-group-addon'>{$this->addon}</span>", $this->_container);
        }
        if ($this->type == self::TYPE_RANGE) {
            Html::addCssClass($this->_container, 'input-daterange');
            if (isset($this->form)) {
                Html::addCssClass($this->options, 'form-control kv-field-from');
                Html::addCssClass($this->options2, 'form-control kv-field-to');
                $input = $this->form->field($this->model, $this->attribute, [
                    'template' => '{input}{error}',
                    'options' => ['class' => 'kv-container-from form-control'],
                ])->textInput($this->options);
                $input2 = $this->form->field($this->model, $this->attribute2, [
                    'template' => '{input}{error}',
                    'options' => ['class' => 'kv-container-to form-control'],
                ])->textInput($this->options2);
            } else {
                if (empty($this->options2['id'])) {
                    $this->options2['id'] = $this->hasModel() ? Html::getInputId($this->model, $this->attribute2) : $this->getId() . '-2';
                }
                Html::addCssClass($this->options2, 'form-control');
                $input2 = $this->hasModel() ?
                    Html::activeTextInput($this->model, $this->attribute2, $this->options2) :
                    Html::textInput($this->name2, $this->value2, $this->options2);
            }
            return Html::tag('div', "$input$input2", $this->_container);
        }
        if ($this->type == self::TYPE_INLINE) {
            $this->_id = $this->options['id'] . '-inline';
            $this->_container['id'] = $this->_id;
            return Html::tag('div', '', $this->_container) . $input;
        }
    }
}
