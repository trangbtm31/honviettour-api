<?php

// Route::middleware('auth:api')->group(function() {
    Route::get('news/categories', 'NewsController@categories');
    Route::apiResource('news', 'NewsController');
// });
