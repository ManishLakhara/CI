<?php

use App\Http\Controllers\admin\CountryCityController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavouriteMissionController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('fetch-city',[CountryCityController::class,'fetchCity']);
Route::post('add-favourite',[FavouriteMissionController::class,'addFavourite']);
Route::post('remove-favourite',[FavouriteMissionController::class,'removeFavourite']);