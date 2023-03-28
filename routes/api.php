<?php

use App\Http\Controllers\admin\CountryCityController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavouriteMissionController;
use App\Http\Controllers\MissionInviteController;
use App\Http\Controllers\UserEditProfileController;
use App\Models\MissionApplication;

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
Route::post('fetch-city', [CountryCityController::class, 'fetchCity']);
Route::post('add-favourite', [FavouriteMissionController::class, 'addFavourite']);
Route::post('remove-favourite', [FavouriteMissionController::class, 'removeFavourite']);
Route::post('invite-user', [MissionInviteController::class, 'inviteUser']);
Route::post('/users/update-password', [UserEditProfileController::class, 'updatePassword'])->name('users.update-password');


Route::post('/users/update-skills', [UserEditProfileController::class, 'updateSkills'])->name('users.update-skills');
Route::post('fetch-comment', [CommentController::class,'showComments']);
Route::post('add-comment',[CommentController::class,'addComment']);
Route::post('recent-volunteer',[MissionApplication::class,'showVolunteer']);
