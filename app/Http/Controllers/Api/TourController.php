<?php

namespace Honviettour\Http\Controllers\Api;

use Honviettour\Models\Tour;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Honviettour\Http\Controllers\Controller;
use Honviettour\Facades\API;
use Honviettour\Services\TourService;
use Honviettour\Http\Requests\TourRequest;

class TourController extends Controller
{
    private $service;
    public function __construct(TourService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->service->search($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourRequest $request)
    {
        $newTour = $this->service->create($request);
        return API::response($newTour, Response::HTTP_CREATED);
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
        return API::response($tour, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Honviettour\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(TourRequest $request, Tour $tour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Honviettour\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour)
    {
        $tour->delete();
        return Api::response(null, Response::HTTP_NO_CONTENT);
    }
}
