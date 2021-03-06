<?php

namespace Honviettour\Admin\Controllers;

use Encore\Admin\Admin;
use Honviettour\Models\News;
use Honviettour\Models\NewsCategory;
use Honviettour\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use DB;

class NewsController extends Controller
{
    use HasResourceActions;

    public $model;

    public function __construct(News $news)
    {
        $this->model = $news;
    }

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
        $grid->newsCategory('Category')->display(function() {
            $category = array_map(function($item) {
                return "<span>{$item['lang']}: {$item['name']}</span><br>";
            }, $this->newsCategory->trans->toArray());
            return implode('', $category);
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
        $grid->status('Published')->display(function() {
            return $this->status === 1 ? 'Yes' : 'No';
        });
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
        });

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
        $form = new Form($this->model);
        $categoryApplyCode = News::CATEGORY_APPLY_CODE;
        Admin::script('checkCategory()');

        $form->normalSelect('category', 'Category')->options($this->model->getAllCategories()->pluck('name', 'id'))->rules('required')->attribute(['data-categoryApplyCode' => $categoryApplyCode]);

        $form->image('image', 'Image')->rules('required')->move('images/news');

        // INFORMATION IN MULTIPLE LANGUAGES
        $form->tabs('trans', 'Information', function(Form\NestedForm $form) {
            $form->normalSelect('lang', 'Language')
                ->options(config('constants.languages'))->rules('required')->default('en');
            $form->text('title', 'Title')->rules('required|min:3');
            $form->textarea('content', 'Content')->rules('required|min:3');
        })->tabKey('lang')->setSummernoteFields(['.content'])->rules('required');

        $form->text('code', 'Code');
        $form->datetime('expire_date', 'Expire date')->default(date('Y-m-d H:i:s'));
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
