<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\PasswordResetController;
use Illuminate\Support\Facades\Route;
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
//frontend Routes
Route::get('/', [AuthController::class,'index'])->name('login');
Route::get('index', function() {
    return view('index');
})->name('index');

Route::post('custom-login',[AuthController::class,'postLogin'])->name('login.custom');

Route::get('forgot', function() {
    return view('login.forgot');
})->name('forgot.password');

Route::post('reset',[PasswordResetController::class,'resetPassword'])->name('check.email');

Route::post('reset-Password',[ForgotPasswordController::class,''])->name('reset.password');


Route::get('register',function() {
    return view('register.register');
})->name('register');

Route::get('forgot-password/{$token}',[PasswordResetController::class,'modifyPassword']);
Route::post('register',[AuthController::class,'register'])->name('post-register');

//frontend Routes




//backend routes
    Route::get('admindashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');
    Route::post('admindashboard', [AdminAuthController::class, 'index'])->name('dashboard');
    Route::get('adminlogin', [AdminAuthController::class, 'login']);
    Route::post('admincustomlogin', [AdminAuthController::class, 'customLogin'])->name('admincustomlogin');
//end backend route
