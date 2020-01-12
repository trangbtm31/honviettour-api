<?php

namespace Honviettour\Admin\Controllers;

use Encore\Admin\Admin;
use Honviettour\Models\Tour;
use Honviettour\Models\Plan;
use Honviettour\Models\Country;
// use Honviettour\Models\Image;
use Honviettour\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Honviettour\Traits\CommonTrait;

class TourController extends Controller
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
        $grid->model()->orderBy('start_date', 'desc');
        $grid->paginate(config('constants.ADMIN_ITEM_PER_PAGE'));
        $grid->disableRowSelector();

        // $grid->id('ID');
        $grid->photo('Photo')->display(function ($img) {
            return $img ? '<img width="30" src="'  . url('storage/' . $img) . '""/>' : '';
        });

        $grid->column('Name')->display(function () {
            $names = array_map(function ($item) {
                return "<span>{$item['lang']}: {$item['name']}</span><br>";
            }, $this->trans->toArray());
            return implode('', $names);
        });

        $grid->column('Country')->display(function () {
            return $this->country ? $this->country->name : null;
        });
        $grid->start_place('Start place');
        $grid->start_date('Start Date')->display(function ($date) {
            return date('d-M-Y', strtotime($date));
        });
        $grid->end_date('End Date')->display(function ($date) {
            return date('d-M-Y', strtotime($date));
        });
        $grid->available_number('Available No.');
        $grid->status('Published')->display(function () {
            return $this->status === 1 ? 'Yes' : 'No';
        });
        $grid->status('Is pilgrimage')->display(function () {
            return $this->is_pilgrimage === 1 ? 'Yes' : 'No';
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
        Admin::script('bindSelect2()');
        $form = new Form(new Tour);
        $form->display('id', 'ID');
        $form->text('short_code', 'Short code');
        $form->switch('is_pilgrimage', 'Is pilgrimage?')->default(0);
        $form->normalSelect('country_id', 'Country')
            ->options(Country::orderBy('name', 'asc')->get()->pluck('name', 'id'));
        $form->text('start_place', 'Start place')->rules('required');
        $form->date('start_date', 'Start Date')->rules('required')->default(date('Y-m-d'));
        $form->date('end_date', 'End Date')->rules('required')->default(date('Y-m-d', strtotime('+3 days')));
        $form->number('available_number', 'Available Number')->default(1)->rules('required');
        $form->divide();
        $photoUniqname = str_random(16) . '.jpg';
        $form->image('photo', 'Photo')->rules('required')->move('images/tours', $photoUniqname);
        // $form->multipleImage('gallery', 'Gallery');

        // INFORMATION IN MULTIPLE LANGUAGES
        $form->tabs('trans', 'Information', function (Form\NestedForm $form) {
            $form->normalSelect('lang', 'Language')
                ->options(config('constants.languages'))->rules('required')->default('en');
            $form->text('name', 'Name')->rules('required');
            // $form->textarea('description', 'Description')->rows(4)->rules('required');
            $form->textarea('note', 'Note')->rows(2);
            $form->textarea('service', 'Service')->rules('required|min:3');
            $form->textarea('detail', 'Details')->rules('required|min:3');
        })->tabKey('lang')->setSummernoteFields(['.detail', '.service'])->rules('required');

        // PRICE
        $priceOptions = config('constants.tour_prices');
        $form->tabs('prices', 'Price', function (Form\NestedForm $form) use ($priceOptions) {
            $form->text('type')->rules('required');
            $form->number('value')->rules('required')->default(0);
            $form->textarea('description')->rows(4);
            $form->hidden('model_type')->default(get_class(new Tour));
        })->rules('required');
        $planObj = Plan::with(['trans' => function ($q) {
            return $q->orderBy('lang', 'asc');
        }])->where([
            // ['date', '>=', date('Y-m-d')],
            ['status', '=', 1]
        ])->orderBy('date', 'asc')->get();

        // PLAN
        $plans = [];
        $planAttrs = [];
        foreach ($planObj as $key => $plan) {
            $plans[$plan->id] = isset($plan->trans[0]) ? $plan->trans[0]->title . (isset($plan->trans[1]) ? ' | ' . $plan->trans[1]->title : '') : $plan->id;
            $planAttrs[$plan->id] = [
                'label' => isset($plan->trans[0]) ? $plan->trans[0]->title . (isset($plan->trans[1]) ? ' | ' . $plan->trans[1]->title : '') : $plan->id,
                'image' => url('storage/' . $plan->photo),
                'date' => date('d-M-Y', strtotime($plan->date)),
                'country' => $plan->country_id
            ];
            if (isset($plan->trans[0])) {
                $planAttrs[$plan->id]['titles'][$plan->trans[0]->lang] = $plan->trans[0]->title;
                $planAttrs[$plan->id]['descriptions'][$plan->trans[0]->lang] = str_limit($plan->trans[0]->description, 2000);
            }
            if (isset($plan->trans[1])) {
                $planAttrs[$plan->id]['titles'][$plan->trans[1]->lang] = $plan->trans[1]->title;
                $planAttrs[$plan->id]['descriptions'][$plan->trans[1]->lang] = str_limit($plan->trans[1]->description, 2000);
            }
        }
        $form->advancedMultipleSelect('plans')->options($plans)->attr($planAttrs)->rules('required');

        $form->switch('status', 'Published')->default(1);
        ;
        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');

        $form->saved(function (Form $form) use ($photoUniqname) {
            $form->photo !== null and $this->saveImages(public_path('storage/images/tours/'), $photoUniqname);
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
