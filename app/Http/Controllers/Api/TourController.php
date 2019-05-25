<?php

namespace Honviettour\Http\Controllers\Api;

use Honviettour\Models\Tour;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Honviettour\Http\Controllers\Controller;
use Honviettour\Http\Resources\TourResource;
use Honviettour\Http\Resources\TourCollection;
use Api;
// use DB;

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
        // DB::enableQueryLog();
        $tours = $this->model->search($request);
        // var_dump(DB::getQueryLog());
        return Api::response(new TourCollection($tours), Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Honviettour\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour, Request $request)
    {
        $tour = $tour->show($tour, $request);
        return Api::response(new TourResource($tour), Response::HTTP_OK);
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
