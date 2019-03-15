<?php

namespace Honviettour\Http\Controllers\Api;

use Honviettour\Models\Tour;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Honviettour\Http\Controllers\Controller;
use Api;

class TourController extends Controller
{
    private $model;
    public function __construct(Tour $tour)
    {
        $this->model = $tour;
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
     * @param  \Honviettour\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        $tour->trans;
        $tour->images;
        $tour->prices;
        $tour->plans;
        return Api::response($tour, Response::HTTP_OK);
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
    public function update(Request $request, Tour $tour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Honviettour\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour)
    {
        //
    }

}
