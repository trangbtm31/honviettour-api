<?php

namespace Honviettour\Http\Controllers\Api;

use Honviettour\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Honviettour\Http\Controllers\Controller;
use Honviettour\Http\Resources\PromotionResource;
use Honviettour\Http\Resources\PromotionCollection;
use Api;

class PromotionController extends Controller
{
    private $model;
    public function __construct(Promotion $promotion)
    {
        $this->model = $promotion;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Promotion $promotion)
    {
        $promotion = $promotion->where('expire_date', '>', date('Y-m-d'))->get();
        foreach($promotion as $item) {
            $result[] = new PromotionResource($item);
        }
        return Api::response($result, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  \Honviettour\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Honviettour\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Honviettour\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Honviettour\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        //
    }
}
