<?php
Route::group([
    'namespace' => 'Honviettour\Http\Controllers',
], function() {
    Auth::routes();
});
Route::group([
    'prefix' => 'oauth',
    'namespace' => 'Honviettour\Http\Controllers',
], function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
});