<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\IndexController;
use App\Http\Controllers\admin\AdminAuthController;
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

Route::get('/', [AuthController::class,'index'])->name('login');
Route::get('index', function() {
    return view('index');
})->name('index');

Route::post('check-email',[ForgotPasswordController::class,'checkEmail'])->name('check.email');
Route::post('custom-login',[AuthController::class,'postLogin'])->name('login.custom');

Route::get('forgot', function() {
    return view('login.forgot');
})->name('forgot.password');

Route::get('reset',function(){
    return view('reset');
});

Route::post('reset-Password',[ForgotPasswordController::class,''])->name('reset.password');


//backend routes
    Route::get('admindashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');
    Route::post('admindashboard', [AdminAuthController::class, 'index'])->name('dashboard');
    Route::get('adminlogin', [AdminAuthController::class, 'login']);
    Route::post('admincustomlogin', [AdminAuthController::class, 'customLogin'])->name('admincustomlogin');
//end backend route
