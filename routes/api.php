<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'cars'          => App\Http\Controllers\CarController::class,
    'brands'        => App\Http\Controllers\BrandController::class,
    'customers'     => App\Http\Controllers\CustomerController::class,
    'car-rentals'   => App\Http\Controllers\CarRentalController::class,
    'vehicle-models'=> App\Http\Controllers\VehicleModelController::class,
]);
