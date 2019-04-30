<?php

namespace Honviettour\Admin\Controllers;

use Honviettour\Models\Promotion;
use Honviettour\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PromotionController extends Controller
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
        $grid = new Grid(new Promotion);

        $grid->id('Id')->sortable();
        $grid->content('Content');
        $grid->code('Code');
        $grid->expire_date('Expire date');
        $grid->image('Image')->display(function($image) {
            return '<img width="30" src="' .  (env('APP_URL') . '/storage/' . ($image ?: 'images/default.png')) . '""/>';
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
        $show = new Show(Promotion::findOrFail($id));

        $show->id('Id');
        $show->content('Content');
        $show->code('Code');
        $show->expire_date('Expire date');
        $show->image('Image');
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
        $form = new Form(new Promotion);

        $form->text('content', 'Content');
        $form->text('code', 'Code');
        $form->datetime('expire_date', 'Expire date')->default(date('Y-m-d H:i:s'));
        $form->image('image', 'Image')->rules('required')->move('images/promotions');;

        return $form;
    }
}
