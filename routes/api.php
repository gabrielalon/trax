<?php

use Components\CarSegment\Adapters\Infrastructure\ORM\Car;
use Components\CarSegment\Adapters\UI\Http\CarCreateHttpAdapter;
use Components\CarSegment\Adapters\UI\Http\CarGetHttpAdapter;
use Components\CarSegment\Adapters\UI\Http\CarListHttpAdapter;
use Components\CarSegment\Adapters\UI\Http\CarRemoveHttpAdapter;
use Components\CarSegment\Adapters\UI\Http\CarTripCreateHttpAdapter;
use Components\CarSegment\Adapters\UI\Http\CarTripListHttpAdapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::middleware('auth:api')->group(static function () {
    Route::get('/trips', CarTripListHttpAdapter::class);

    Route::get('/cars', CarListHttpAdapter::class);
    Route::get('/car/{carId}', CarGetHttpAdapter::class)->can('access', [Car::class, 'carId']);
    Route::post('/car', CarCreateHttpAdapter::class);
    Route::delete('/car/{carId}', CarRemoveHttpAdapter::class)->can('access', [Car::class, 'carId']);

    Route::post('/car/{carId}/trip', CarTripCreateHttpAdapter::class)->can('access', [Car::class, 'carId']);
});
