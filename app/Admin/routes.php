<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('demo/users', UserController::class);

    $router->resource('tours', TourController::class);

    $router->resource('price', PriceController::class);

    $router->resource('plans', PlanController::class);

    $router->resource('hotels', HotelController::class);
});


