<?php

namespace Honviettour\Providers;

use Illuminate\Support\ServiceProvider;
use Honviettour\Admin\Extensions\Field\Tabs;
use Honviettour\Admin\Extensions\Field\AdvancedMultipleSelect;
use Honviettour\Admin\Extensions\Field\Select;
use Encore\Admin\Admin;
use Encore\Admin\Form;

class AdminFieldServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        Admin::booting(function () {
            Form::extend('tabs', Tabs::class);
            Form::extend('advancedMultipleSelect', AdvancedMultipleSelect::class);
            Form::extend('select', Select::class);
        });
    }
}