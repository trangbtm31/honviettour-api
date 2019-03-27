<?php
Route::group(['prefix' => 'oauth', /*'middleware' => ''*/], function() {
    Route::get('/tokens', 'TokenController@index')->name('tokens');
});
