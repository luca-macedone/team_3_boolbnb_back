<?php

use App\Http\Controllers\API\ApartmentController as APIApartmentController;
use App\Http\Controllers\API\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/user/details', [UserController::class, 'user_data']);
Route::get('/apartments/{left_lat}/{left_lon}/{right_lat}/{right_lon}', [APIApartmentController::class, 'concerned_list']);
Route::get('/apartments', [APIApartmentController::class, 'index']);
Route::get('/apartments/{apartment:slug}', [APIApartmentController::class, 'show']);
