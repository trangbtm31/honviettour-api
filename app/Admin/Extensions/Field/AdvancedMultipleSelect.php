<?php

namespace Honviettour\Admin\Extensions\Field;

// use Encore\Admin\Form\Field;
use Encore\Admin\Form\Field\MultipleSelect as EncoreMultopleSelect;

/**
 * Class HasMany.
 */
class AdvancedMultipleSelect extends EncoreMultopleSelect
{
    protected $view = 'admin.multipleselect';
    protected $attr = [];

    protected static $js = [
        'js/select2.min.js'
    ];
    protected static $css = [
        'css/select2.css',
    ];

    public function attr($arr)
    {
        $this->attr = $arr;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        if ($this->options instanceof \Closure) {
            if ($this->form) {
                $this->options = $this->options->bindTo($this->form->model());
            }

            $this->options(call_user_func($this->options, $this->value, $this));
        }

        $this->options = array_filter($this->options, 'strlen');
        $this->addVariables([
            'options' => $this->options,
            'groups'  => $this->groups,
            'attr'  => $this->attr,
        ]);

        $this->attribute('data-value', implode(',', (array) $this->value()));

        if (!$this->shouldRender()) {
            return '';
        }

        return view($this->getView(), $this->variables());
    }
}
