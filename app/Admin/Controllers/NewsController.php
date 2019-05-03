<?php

namespace Honviettour\Admin\Controllers;

use Encore\Admin\Admin;
use Honviettour\Models\News;
use Honviettour\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class NewsController extends Controller
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
        $grid = new Grid(new News);

        $grid->id('Id')->sortable('desc');
        $grid->paginate(config('constants.ADMIN_ITEM_PER_PAGE'));
        $grid->category('Category')->display(function($category) {
            $result = [ 'News', 'Promotion'];
            return $result[$category];
        });
        $grid->image('Image')->display(function($image) {
            return '<img width="30" src="' .  (env('APP_URL') . '/storage/' . ($image ?: 'images/default.png')) . '""/>';
        });
        $grid->column('Title')->display(function () {
            $names = array_map(function($item) {
                return "<span>{$item['lang']}: {$item['title']}</span><br>";
            }, $this->trans->toArray());
            return implode('', $names);
        });
        $grid->code('Code');
        $grid->expire_date('Expire date');
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
        $show = new Show(News::findOrFail($id));

        $show->id('Id');
        $show->category('Category');
        $show->image('Image');
        $show->code('Code');
        $show->expire_date('Expire date');
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
        $form = new Form(new News);
        Admin::js(['js/admin.js']);
        Admin::script('checkCategory()');
        $categories = ['News','Promotion'];

        $form->normalSelect('category', 'Category')->options($categories);
        $form->image('image', 'Image');

        // INFORMATION IN MULTIPLE LANGUAGES
        $form->tabs('trans', 'Information', function(Form\NestedForm $form) {
            $form->normalSelect('lang', 'Language')
                ->options(config('constants.languages'))->rules('required')->default('en');
            $form->text('title', 'Title')->rules('required|min:3');
            $form->textarea('content', 'Content')->rules('required|min:3');
        })->tabKey('lang')->setSummernoteFields(['.content'])->rules('required');

        $form->text('code', 'Code');
        $form->datetime('expire_date', 'Expire date')->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
