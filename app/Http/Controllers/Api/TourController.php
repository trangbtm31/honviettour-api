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

}
