<?php

namespace Honviettour\Admin\Controllers;

use Honviettour\Models\Plan;
use Honviettour\Models\Country;
use Honviettour\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Honviettour\Traits\CommonTrait;

class PlanController extends Controller
{
    use HasResourceActions, CommonTrait;

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
            ->description('List Plans')
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
            ->description('Plan')
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
            ->description('Edit Plan')
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
            ->description('Create new Plan')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Plan);
        $grid->model()->orderBy('date', 'desc');
        $grid->disableRowSelector();

        // $grid->id('Id');
        $grid->photo('Photo')->display(function ($img) {
            return $img ? '<img width="30" src="'  .(env('APP_URL') . '/storage/' . $img) . '""/>' : '';
        });

        $grid->column('Title')->display(function () {
            $titles = array_map(function($item) {
                return "<span>{$item['lang']}: {$item['title']}</span><br>";
            }, $this->trans->toArray());
            return implode('', $titles);
        });
        $grid->column('Country')->display(function () {
            return $this->country ? $this->country->name : null;
        });
        $grid->date('Date')->display(function($date) {
            return date('d-M-Y', strtotime($date));
        });
        $grid->status('Published')->display(function() {
            return $this->status === 1 ? 'Yes' : 'No';
        });
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
        $show = new Show(Plan::findOrFail($id));

        $show->id('Id');

        $show->title('Title');
        $show->description('Description');
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
        $form = new Form(new Plan);
        $form->date('date', 'Date')->rules('required')->default(date('Y-m-d'));
        $form->normalSelect('country_id', 'Country')
            ->options(Country::all()->pluck('name', 'id'));
        $photoUniqname = str_random(16) . '.jpg';
        $form->image('photo', 'Photo')->rules('required')->move('images/plans', $photoUniqname);
        $form->tabs('trans', 'Information', function(Form\NestedForm $form) {
            $form->normalSelect('lang', 'Language')
                ->options(config('constants.languages'))->rules('required')->default('en');
            $form->text('title', 'Title')->rules('required');
            $form->textarea('description', 'Description')->rules('required|min:3');
        })->tabKey('lang')->setSummernoteFields(['.description'])->rules('required');
        $form->switch('status', 'Published')->default(1);
        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');

        $form->saved(function (Form $form) use ($photoUniqname) {
            $form->photo !== null and $this->saveImages(public_path('storage/images/plans/'), $photoUniqname);
            return false;
        });

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
