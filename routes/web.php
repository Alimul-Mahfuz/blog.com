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
})->name('home');


Route::post('logout', [AuthenticationController::class, 'logout'])->name('user.logout');

Route::middleware('user.guest')->group(function () {
    Route::get('login', [AuthenticationController::class, 'login'])->name('user.login');
    Route::get('register', [AuthenticationController::class, 'register'])->name('user.register');
    Route::post('register', [AuthenticationController::class, 'post_register']);
    //Google
    Route::get('/auth/google/redirect', [AuthenticationController::class, 'google_singin_redirect'])->name('user.google_redirect');
    Route::get('/auth/google/callback', [AuthenticationController::class, 'google_singin_callback'])->name('user.google_callback');
    // Twitter
    Route::get('/auth/twitter/redirect', [AuthenticationController::class, 'twitter_singin_redirect'])->name('user.twitter_redirect');
    Route::get('/auth/twitter/callback', [AuthenticationController::class, 'twitter_singin_callback'])->name('user.twitter_callback');
});

Route::middleware('user.auth')->group(function () {
    Route::get('/test-auth/{id}', function ($id) {
        return "You have passed the middleware $id";
    });
});