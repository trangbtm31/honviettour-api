<?php

namespace Honviettour\Http\Controllers\Api;

use Honviettour\Models\Feedback;
use Illuminate\Http\Request;
use Honviettour\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Api;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Api::response(Feedback::all(), Response::HTTP_OK);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            'first_name'        => 'required',
            'last_name'         => 'required',
            'email'             => 'email',
            'phone'             => 'numeric',
            'content'           => 'required'
        ]);

        if ($validator->fails()) {
            $message = $validator->errors();
            return Api::response(['message' => $message], Response::HTTP_NOT_FOUND);
        } else {
            // store
            $feedback = new Feedback();
            $feedback->first_name       = $request->input('first_name');
            $feedback->last_name        = $request->input('last_name');
            $feedback->email            = $request->input('email');
            $feedback->phone            = $request->input('phone', '');
            $feedback->content          = $request->input('content');
            $feedback->save();

            return Api::response($feedback, Response::HTTP_OK);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Honviettour\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Honviettour\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Honviettour\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Honviettour\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
