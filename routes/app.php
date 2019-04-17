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

use Illuminate\Routing\Router;


Route::get('/', function () {
    return view('welcome');
});

foreach ( File::allFiles(__DIR__ . '/admin') as $partial) {
   require $partial->getPathname();
}

Admin::registerAuthRoutes();
Route::group([
    'prefix'        => config('admin.route.prefix'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'Admin/Controllers/HomeController@index');
    $router->resource('demo/users', Honviettour\Admin\Controllers\UserController::class);

    $router->resource('tours', Honviettour\Admin\Controllers\TourController::class);

    // $router->resource('price', PriceController::class);

    $router->resource('plans', Honviettour\Admin\Controllers\PlanController::class);

    $router->resource('hotels', Honviettour\Admin\Controllers\HotelController::class);
});

/*foreach ( File::allFiles(__DIR__ . '/web') as $partial) {
    require $partial->getPathname();
}*/
