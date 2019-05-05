<?php

namespace Honviettour\Http\Controllers\Api;

use Honviettour\Models\News;
use Illuminate\Http\Request;
use Honviettour\Http\Resources\NewsCollection;
use Honviettour\Http\Resources\NewsResource;
use Honviettour\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Api;

class NewsController extends Controller
{
    private $model;
    public function __construct(News $news)
    {
        $this->model = $news;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categoryArr = ['news' => 0, 'promotion' => 1];
        $category = $request->query->get('category'. '');

        if($category) {
            $request['condition'] = [
                'category' => $categoryArr[$category]
            ];
        }

        $news = $this->model->search($request);
        return Api::response(new NewsCollection($news), Response::HTTP_OK);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \Honviettour\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news, Request $request)
    {
        //
        $news = $news->show($news, $request);
        return Api::response(new NewsResource($news), Response::HTTP_OK);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Honviettour\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Honviettour\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Honviettour\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }
}
