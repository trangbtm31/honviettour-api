<?php

namespace Honviettour\Admin\Controllers;

use Honviettour\Models\Hotel;
use Honviettour\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Honviettour\Models\Country;

class HotelController extends Controller
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
        $grid = new Grid(new Hotel);
        $grid->paginate(config('constants.ADMIN_ITEM_PER_PAGE'));
        $grid->disableRowSelector();

        $grid->id('Id');
        $grid->images('Photo')->display(function () {
            return count($this->images) ? '<img width="30" src="'  .(env('APP_URL') . '/storage/' . $this->images[0]['path']) . '""/>' : '';
        });

        $grid->name('Name');
        $grid->description('Description')->limit(20);
        $grid->address('Address');
        $grid->column('Country')->display(function () {
            return $this->countryInfo['name'];
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
        $show = new Show(Hotel::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->description('Description');
        $show->address('Address');
        $show->country('Country');
        $show->photo('Photo');
        $show->service('Service');
        $show->latitude('Latitude');
        $show->longitude('Longitude');
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
        $form = new Form(new Hotel);

        $form->text('name', 'Name');
        $form->hasMany('images', 'Photo', function(Form\NestedForm $form) {
            $form->image('path', 'Photo');
            $form->switch('status', 'Published');
            $form->hidden('model_type');
        });
        $form->text('address', 'Address');
        $form->select('country', 'Country')->options(Country::all()->pluck('name', 'id'));
        $form->textarea('description', 'Description')->rows(4);
        $form->decimal('latitude', 'Latitude');
        $form->decimal('longitude', 'Longitude');
        $form->summernote('service', 'Service');

        $form->switch('status', 'Published');
        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');

         $form->saving(function (Form $form) {
            $form->images = array_map(function($item) {
                $item['model_type'] = get_class(new Hotel);
                return $item;
            }, $form->images);
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
