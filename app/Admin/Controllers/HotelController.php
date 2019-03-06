<?php

namespace Honviettour\Admin\Controllers;

use Honviettour\Models\Hotel;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

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

        $grid->id('Id');
        $grid->name('Name');
        $grid->description('Description');
        $grid->address('Address');
        $grid->country('Country');
        $grid->photo('Photo');
        $grid->service('Service');
        $grid->latitude('Latitude');
        $grid->longitude('Longitude');
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
        $form->textarea('description', 'Description');
        $form->text('address', 'Address');
        $form->text('country', 'Country');
        $form->text('photo', 'Photo');
        $form->text('service', 'Service');
        $form->decimal('latitude', 'Latitude');
        $form->decimal('longitude', 'Longitude');

        return $form;
    }
}
