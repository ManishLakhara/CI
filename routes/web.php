<?php

use App\Http\Controllers\admin\MissionThemeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\admin\MissionSkillController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MissionDetailController;
use Faker\Provider\HtmlLorem;
use Faker\Provider\Lorem;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\ForgetPasswordController;
use App\Http\Controllers\Admin\AdminPasswordResetController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\MissionController;
use App\Http\Controllers\admin\CmsPageController;
use App\Http\Controllers\admin\StoryController;
use App\Http\Controllers\CmsPagesController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ShareYourStoryController;
use App\Http\Controllers\MissionApplicationController;
use App\Http\Controllers\UserEditProfileController;
use App\Http\Controllers\VolunteeringTimesheetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//frontend Routes
Route::get('/', [AuthController::class, 'index'])->name('login');

Route::get('index', function () {
    return view('index');
})->name('index');

Route::get('logout', [AuthController::class, 'logout']);


Route::post('custom-login', [AuthController::class, 'postLogin'])->name('login.custom');

Route::get('forgot', function () {
    return view('login.forgot');
})->name('forgot.password');

Route::post('reset', [PasswordResetController::class, 'resetPassword'])->name('check.email');

Route::get('register', function () {
    return view('register.register');
})->name('register');

Route::get('forgot-password/{token}', function ($token) {
    return view('reset', [$token]);
});
Route::post('register', [AuthController::class, 'register'])->name('post-register');

Route::post('password-resetting', [PasswordResetController::class, 'passwordResetting'])->name('password-resetting');




//frontend Routes




//backend routes
Route::get('admindashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');
Route::post('admindashboard', [AdminAuthController::class, 'index'])->name('dashboard');
Route::get('adminlogin', [AdminAuthController::class, 'login'])->name('adminlogin');
Route::post('admincustomlogin', [AdminAuthController::class, 'customLogin'])->name('admincustomlogin');
Route::get('forgetpassword', [ForgetPasswordController::class, 'forgetpassword'])->name('forgetpassword');
Route::post('resetpassword', [ForgetPasswordController::class, 'resetpassword'])->name('resetpassword');
Route::post('admin-check-email', [ForgetPasswordController::class, 'admincheckEmail'])->name('admin.check.email');
Route::get('resetpassword', [ForgetPasswordController::class, 'resetpassword'])->name('resetpassword');
Route::post('resetpassword2', [AdminPasswordResetController::class, 'resetPassword'])->name('resetpassword2');
Route::get('admin-mission-application',[MissionApplicationController::class, 'index']);
Route::get('adminresetpage/{token}', function () {
    return view('admin.auth.resetpassword');

});

Route::post('admin-password-resetting', [AdminPasswordResetController::class, 'adminPasswordResetting'])->name('adminPasswordResetting');

// Route::get('adminresetpage',function(){
    //     return view('admin.auth.login');
    // });
    // Route::get('missiontheme/delete/{slug}', [MissionThemeController::class,'delete']);
    // Route::post('missiontheme/new',[MissionThemeController::class,'new'])->name('missiontheme.new');
    // Route::get('missiontheme',[MissionThemeController::class,'getAll']);
    // Route::get('missionskill',[SkillController::class,'getAll']);
    // Route::post('missionskill/new',[SkillController::class,'new'])->name('missionskill.new');
    // Route::get('missionskill/delete/{slug}', [SkillController::class,'delete']);
Route::get('admin-story-published/{story_id}',[StoryController::class,'updateToPublished'])->name('admin-story.published');
Route::get('admin-story-declined/{story_id}',[StoryController::class,'updateToDeclined'])->name('admin-story.declined');
Route::resource('admin-story',StoryController::class)->only(['index','show','destroy']);
Route::resource('missiontheme', MissionThemeController::class)->withTrashed();
Route::resource('missionskill', MissionSkillController::class)->withTrashed();
Route::resource('user', UserController::class)->withTrashed();
Route::resource('mission', MissionController::class);
Route::resource('cmspage', CmsPageController::class);
Route::resource('banner',BannerController::class);
//end backend route




Route::get('cms',[CmsPagesController::class, 'index'])->name('policy-page');
Route::get('index',[LandingPageController::class, 'index'])->name('landing.index')->middleware('auth');
Route::get('index-filter',[LandingPageController::class, 'filterApply'])->name('landing.filterApply')->middleware('auth');
Route::get('index/find-city',[LandingPageController::class, 'findCity']);
Route::get('index/find-theme',[LandingPageController::class, 'findTheme']);
Route::get('index/find-skill',[LandingPageController::class, 'findSkill']);
Route::get('filter-data',[LandingPageController::class,'filterData']);

Route::put('update-profile', [UserEditProfileController::class,'updateProfile'])->name('update-profile');

Route::get('edit-profile/{user_id}', [UserEditProfileController::class,'editProfile'])->name('edit-profile')->middleware('auth');
Route::post('logout', [UserEditProfileController::class,'logout'])->name('logout');
//Route::post('update-password', [UserEditProfileController::class, 'updatePassword'])->name('update-password')->middleware('auth');

Route::get('mission-page/{mission_id}',[MissionDetailController::class,'main'])->name('mission-page');

Route::resource('timesheet',VolunteeringTimesheetController::class);

Route::get('share-your-story',[ShareYourStoryController::class,'index']);


Route::resource('stories', ShareYourStoryController::class);
Route::get('download/{filename}',[DownloadController::class,'download']);
