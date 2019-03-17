<?php

namespace Honviettour\Admin\Extensions\Field;

use Encore\Admin\Form\Field\Select as EncoreSelect;

/**
 * Class HasMany.
 */
class Select extends EncoreSelect
{
    protected static $js = [
        'js/select2.min.js'
    ];
    protected static $css = [
        'css/select2.css',
    ];
}
