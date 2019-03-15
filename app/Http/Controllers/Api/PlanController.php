<?php

namespace Honviettour\Http\Controllers\Api;

use Honviettour\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Honviettour\Http\Controllers\Controller;
use Api;

class PlanController extends Controller
{
    private $model;
    public function __construct(Plan $plan)
    {
        $this->model = $plan;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Api::response($this->model->search($request), Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Honviettour\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        $plan->trans;
        $plan->images;
        return Api::response($plan, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Honviettour\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Honviettour\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        //
    }

}
