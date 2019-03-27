<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

foreach ( File::allFiles(__DIR__ . '/admin') as $partial) {
   require $partial->getPathname();
}
/*foreach ( File::allFiles(__DIR__ . '/web') as $partial) {
    require $partial->getPathname();
}*/
