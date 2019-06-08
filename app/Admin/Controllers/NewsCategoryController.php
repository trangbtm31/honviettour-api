<?php

namespace Honviettour\Admin\Controllers;

use Honviettour\Models\NewsCategory;
use Honviettour\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class NewsCategoryController extends Controller
{
    use HasResourceActions;

    public $model;

    public function __construct(NewsCategory $newsCategory)
    {
        $this->model = $newsCategory;
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
        $grid = new Grid(new NewsCategory);

        $grid->paginate(config('constants.ADMIN_ITEM_PER_PAGE'));

        $grid->column('Name')->display(function () {
            $names = array_map(function($item) {
                return "<span>{$item['lang']}: {$item['name']}</span><br>";
            }, $this->trans->toArray());
            return implode('', $names);
        });

        $grid->status('Published')->display(function() {
            return $this->status === 1 ? 'Yes' : 'No';
        })->sortable('desc');
        $grid->created_at('Created at')->sortable('desc');
        $grid->updated_at('Updated at');

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            if(count($actions->row->news)) {
                $actions->disableDelete();
            }
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
        $show = new Show(NewsCategory::findOrFail($id));



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
        $id = !empty(request()->route()->parameters()) ? request()->route()->parameters()['news_category'] : null;
        $deletable = true;
        if($id) {
            $data = $this->model->find($id);
            $deletable = !count($data->news);
        }

        $form->tabs('trans', 'Information', function(Form\NestedForm $form) {
            $form->normalSelect('lang', 'Language')
                ->options(config('constants.languages'))->rules('required')->default('en');
            $form->text('name', 'Name')->rules('required');
        })->tabKey('lang')->rules('required');
        $form->switch('status', 'Published')->default(1);
        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');


        $form->tools(function (Form\Tools $tools) use ($deletable){
            $tools->disableView();
            // Disable `Delete` btn.
            if(!$deletable) {
                $tools->disableDelete();
            }
        });

        $form->footer(function ($footer) {
            // disable `View` checkbox
            $footer->disableViewCheck();

            // disable `Continue Creating` checkbox
            $footer->disableCreatingCheck();

        });

        return $form;
    }
}
