<?php

namespace Honviettour\Admin\Extensions\Field;

use Encore\Admin\Form\Field\Select as EncoreSelect;

/**
 * Class HasMany.
 */
class Select extends EncoreSelect
{
    protected $view = 'admin.normal_select';
    /*protected static $js = [
        'js/select2.min.js'
    ];
    protected static $css = [
        'css/select2.css',
    ];*/

    public function render()
    {
        /*$configs = array_merge([
            'allowClear'  => true,
            'placeholder' => [
                'id'   => '',
                'text' => $this->label,
            ],
        ], $this->config);
        $configs = json_encode($configs);
        if (empty($this->script)) {
            $this->script = "$(\"{$this->getElementClassSelector()}\").select2($configs);";
        }*/
        $this->script = " ";

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
        ]);

        $this->attribute('value', $this->value());

        return parent::render();
    }

}
