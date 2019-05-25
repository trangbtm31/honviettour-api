<?php
Route::group(['prefix' => 'oauth', /*'middleware' => ''*/], function() {
    Route::get('/tokens', 'Honviettour\Http\Controllers\TokenController@index')->name('tokens');
});
