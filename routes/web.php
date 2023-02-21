<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('index', function() {
    return view('index');
})->name('index');


Route::get('forgot',function(){
    return view('forgot');
});

Route::get('check-email',[ForgotPasswordController::class,'checkEmail'])->name('check.email');
Route::post('custom-login',[AuthController::class,'customLogin'])->name('login.custom');

Route::get('forgot',function() {
    return view('forgot');
})->name('forgot.password');