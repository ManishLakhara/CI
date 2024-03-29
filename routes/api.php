<?php

use App\Http\Controllers\admin\CountryCityController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavouriteMissionController;
use App\Http\Controllers\admin\MissionApplicationController;
use App\Http\Controllers\MissionDetailController;
use App\Http\Controllers\MissionInviteController;
use App\Http\Controllers\MissionRatingController;
use App\Http\Controllers\UserEditProfileController;
use App\Http\Controllers\StoryInviteController;
use App\Http\Controllers\StoryListingController;
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

    Route::post('add-favourite', [FavouriteMissionController::class, 'addFavourite']);
    Route::post('remove-favourite', [FavouriteMissionController::class, 'removeFavourite']);
    Route::post('invite-user', [MissionInviteController::class, 'inviteUser']);
    Route::post('/users/update-password', [UserEditProfileController::class, 'updatePassword'])->name('users.update-password');
    Route::get('get-rating/{mission_id}',[MissionDetailController::class, 'getRating']);
    Route::post('/users/update-skills', [UserEditProfileController::class, 'updateSkills'])->name('users.update-skills');
    Route::post('fetch-comment', [CommentController::class,'showComments']);
    Route::post('add-comment',[CommentController::class,'addComment']);
    Route::get('recent-volunteer',[MissionDetailController::class,'showVolunteer']);
    Route::post('add-rating',[MissionRatingController::class,'addRating']);
    Route::post('new-mission-application',[MissionApplicationController::class,'newMissionApplication']);
    Route::get('approve-application',[MissionApplicationController::class,'approveApplication']);
    Route::get('reject-application',[MissionApplicationController::class,'rejectApplication']);
    Route::post('invite-users', [StoryInviteController::class, 'inviteUser']);
    Route::post('/users/contact-us', [UserEditProfileController::class, 'contactus'])->name('users.contact-us');

Route::post('fetch-city', [CountryCityController::class, 'fetchCity']);
