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
    'namespace'    => config('admin.route.namespace'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->any('/uploadImage', 'UploadController@handleImage');
    $router->resource('demo/users', UserController::class);

    $router->resource('tours', TourController::class);

    $router->resource('plans', PlanController::class);

    $router->resource('hotels', HotelController::class);

    $router->resource('promotions', PromotionController::class);

    $router->resource('news', NewsController::class);

    $router->resource('feedbacks', FeedbackController::class);

    $router->resource('banners', BannerController::class);

    $router->resource('schedules', ScheduleController::class);
});
