<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Auth\AuthenticationController;
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
    return view('welcome');
});

Route::get('login',[AuthenticationController::class,'login'])->name('user.login');
Route::get('register',[AuthenticationController::class,'register'])->name('user.register');
