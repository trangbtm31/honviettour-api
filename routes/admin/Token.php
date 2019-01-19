<?php
Route::group(['prefix' => 'admin', /*'middleware' => ''*/], function() {
    Route::get('/tokens', 'TokenController@index')->name('tokens');
});
