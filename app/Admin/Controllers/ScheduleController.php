<?php

namespace Honviettour\Admin\Controllers;

use Honviettour\Models\Schedule;
use Honviettour\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ScheduleController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Schedule);

        $grid->id('Id');
        $grid->column('Tour name')->display(function () {
            $names = array_map(function($item) {
                return "<span>{$item['lang']}: {$item['tour_name']}</span><br>";
            }, $this->trans->toArray());
            return implode('', $names);
        });
        $grid->start_date('Start date');
        $grid->column('Url')->display(function () {
            $names = array_map(function($item) {
                return "<span>{$item['lang']}: {$item['url']}</span><br>";
            }, $this->trans->toArray());
            return implode('', $names);
        });
        $grid->status('Status');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Schedule::findOrFail($id));

        $show->id('Id');
        $show->tour_name('Tour name');
        $show->start_date('Start date');
        $show->url('Url');
        $show->status('Status');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Schedule);

        $form->date('start_date', 'Start date')->default(date('Y-m-d'));

        // INFORMATION IN MULTIPLE LANGUAGES
        $form->tabs('trans', 'Information', function(Form\NestedForm $form) {
            $form->normalSelect('lang', 'Language')
                ->options(config('constants.languages'))->rules('required')->default('en');
            $form->text('tour_name', 'Tour name')->rules('required|min:3');
            $form->url('url', 'Url')->rules('required');
        })->tabKey('lang')->rules('required');
        $form->switch('status', 'Published')->default(1);

        $form->footer(function ($footer) {
            // disable `View` checkbox
            $footer->disableViewCheck();

            // disable `Continue editing` checkbox
            $footer->disableEditingCheck();

            // disable `Continue Creating` checkbox
            $footer->disableCreatingCheck();

        });
        return $form;
    }
}
