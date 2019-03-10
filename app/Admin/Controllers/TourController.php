<?php

namespace Honviettour\Admin\Controllers;

use Honviettour\Models\Tour;
use Honviettour\Models\Plan;
use Honviettour\Models\Image;
use Honviettour\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Honviettour\Admin\Extensions\Field;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
// use Encore\Admin\Widgets\Tab;

class TourController extends Controller
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
            ->header('Tours')
            ->description('List Tours')
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
            ->description('Tour detail')
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
            ->description('Edit Tour')
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
            ->description('Create new tour')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Tour);
        $grid->model()->orderBy('start_date', 'asc');
        $grid->paginate(config('constants.ADMIN_ITEM_PER_PAGE'));
        $grid->disableRowSelector();

        $grid->id('Id');
        $grid->images('Photo')->display(function () {
            return count($this->images) ? '<img width="30" src="'  .(env('APP_URL') . '/storage/' . $this->images[0]['path']) . '""/>' : '';
        });
        $grid->column('Name')->display(function () {
            $names = array_map(function($item) {
                return "<span>{$item['lang']}: {$item['name']}</span><br>";
            }, $this->trans->toArray());
            return implode('', $names);
        });

        $grid->start_place('Start place');
        $grid->start_date('Start Date')->display(function($date) {
            return date('d-M-Y', strtotime($date));
        });
        $grid->end_date('End Date')->display(function($date) {
            return date('d-M-Y', strtotime($date));
        });
        $grid->available_number('Available No.');
        $grid->column('Description')->display(function() {
            $descriptions = array_map(function($item) {
                $des = str_limit($item['description'], 20);
                return "<span>{$item['lang']}: $des</span><br>";
            }, $this->trans->toArray());
            return implode('', $descriptions);
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
        $show = new Show(Tour::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->image('Image');
        $show->description('Description');
        // $show->price_for_baby('Price for baby');
        // $show->price_for_child('Price for child');
        // $show->price_for_adult('Price for adult');
        $show->start_place('Start place');
        $show->start_date('Start Date');
        $show->end_date('End Date');
        $show->available_number('Available Number');
        $show->description('Description');
        $show->service('Service');
        $show->note('Note');
        $show->detail('Detail');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Tour);

        $form->display('id', 'ID');
        $form->text('start_place', 'Start place');
        $form->datetime('start_date', 'Start Date');
        $form->datetime('end_date', 'End Date');
        $form->number('available_number', 'Available Number');
        $form->divide();
        $form->tabs('images', 'Photo', function(Form\NestedForm $form) {
            $form->image('path', 'Photo');
            $form->switch('status', 'Published');
            $form->hidden('model_type')->default(get_class(new Tour));
        });
        $form->tabs('trans', 'Translation', function(Form\NestedForm $form) {
            $form->select('lang', 'Language')
                ->options(config('constants.languages'));
            $form->text('name', 'Name');
            $form->textarea('description', 'Description')->rows(4);
            $form->textarea('note', 'Note')->rows(2);
            $form->textarea('service', 'Service');
            $form->textarea('detail', 'Details');
        })->tabKey('lang');
        $priceOptions = config('constants.tour_prices');
        $form->tabs('prices', 'Price', function (Form\NestedForm $form) use ($priceOptions){
            $form->select('type')
                ->options($priceOptions)
                ->rules('required');
            $form->number('value')->rules('required');
            $form->textarea('description')->rules('required')->rows(4);
            $form->textarea('note')->rules('required')->rows(2);
        });
        $form->divide();
        $form->multipleSelect('plans')->options(Plan::all()->pluck('title', 'id'));
        /*$form->hasMany('plans', 'Plan', function (Form\NestedForm $form) use ($plans) {
            $form->select('Plan')->options($plans)->rules('required');
            $form->text('title', 'Title')->rules('required');
            $form->textarea('description', 'Description')->rules('required');
            $form->image('photo', 'Photo');
        });*/
        $form->divide();
        $form->switch('status', 'Published');
        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');

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
