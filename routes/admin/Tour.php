<?php

// Auth::routes();
Route::group(['prefix' => 'admin'], function() {
    Route::resource('tours', TourController::class);
});
