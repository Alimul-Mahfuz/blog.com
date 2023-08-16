<?php

use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Auth\AuthenticationController;
use App\Mail\PasswordRecoveryEmail;
use App\Models\User;

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

Route::get('/',[HomeController::class,'index'])->name('home');


Route::post('logout', [AuthenticationController::class, 'logout'])->name('user.logout');

Route::middleware('user.guest')->group(function () {
    Route::get('login', [AuthenticationController::class, 'login'])->name('user.login');
    Route::post('login', [AuthenticationController::class, 'login_post']);
    Route::get('register', [AuthenticationController::class, 'register'])->name('user.register');
    Route::post('register', [AuthenticationController::class, 'post_register']);
    Route::get('reset-request',[AuthenticationController::class,'reset_request'])->name('user.password-reset-request');
    Route::post('reset-request',[AuthenticationController::class,'reset_request_post']);
    Route::get('reset-password/{email}/{token}',[AuthenticationController::class,'reset_password'])->name('user.reset-password');
    Route::post('update-password/submit}',[AuthenticationController::class,'update_password'])->name('user.update-password');



    //Google
    Route::get('/auth/google/redirect', [AuthenticationController::class, 'google_singin_redirect'])->name('user.google_redirect');
    Route::get('/auth/google/callback', [AuthenticationController::class, 'google_singin_callback'])->name('user.google_callback');
    // Twitter
    Route::get('/auth/twitter/redirect', [AuthenticationController::class, 'twitter_singin_redirect'])->name('user.twitter_redirect');
    Route::get('/auth/twitter/callback', [AuthenticationController::class, 'twitter_singin_callback'])->name('user.twitter_callback');
});

Route::middleware('user.auth')->group(function () {
    Route::get('dashboard',[DashboardController::class,'profile'])->name('user.profile');
    Route::post('/profile-basic/update',[DashboardController::class,'update_basicInfo'])->name('user.updateBasic');
    Route::post('password-update',[DashboardController::class,'update_password']);
    Route::resource('post', PostController::class);
    Route::post('cke-image/upload',[PostController::class,'cke_upload'])->name('user.post.cke-image');
    Route::post('profile_image/upload',[DashboardController::class,'profile_image_upload'])->name('user.profile-image-upload');
    Route::get('user-post/search/{query?}',[PostController::class,'user_search']);
});

Route::get('post-search/{query?}',[PostController::class,'post_search']);

Route::get('read-blog/{id}',[HomeController::class,'read_blog'])->name('user.read');
// Route::get('/mailable', function () {
//    return new PasswordRecoveryEmail();
// });

Route::get('/db/test',[AuthenticationController::class,'test']);