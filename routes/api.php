<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Settings\GenresController;
use App\Http\Controllers\Settings\ImageController;
use App\Http\Controllers\Settings\FriendshipsController;

use App\Http\Controllers\MoviesController;
use App\Http\Controllers\TVShowsController;
use App\Http\Controllers\SlidersController;
use App\Http\Controllers\StreamController;

use App\Http\Controllers\SearchController;
use App\Http\Controllers\NotificationController;

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth.token'], function () {
    Route::post('logout', [LoginController::class, 'logout']);
    Route::get('user', [UserController::class, 'current']);
    Route::get('user/{id}/profile', [UserController::class, 'show']);

    /*/ USTAWIENIA /*/
    Route::patch('settings/profile', [ProfileController::class, 'update']);
    Route::patch('settings/password', [PasswordController::class, 'update']);
    Route::patch('settings/genres', [GenresController::class, 'update']);

    Route::post('settings/image', [ImageController::class, 'update']);
    Route::delete('settings/image', [ImageController::class, 'destroy']);

    Route::get('settings/frirends/{id}/befriend', [FriendshipsController::class, 'beFriend']);
    Route::post('settings/frirends/accept', [FriendshipsController::class, 'acceptFriendRequest']);
    Route::post('settings/frirends/deny', [FriendshipsController::class, 'denyFriendRequest']);

    Route::get('settings/frirends/{query}/search', [FriendshipsController::class, 'beFriend']);

    Route::get('settings/frirends', [FriendshipsController::class, 'index']);

    // Route::get('settings/frirends/{id}/deny', [FriendshipsController::class, 'denyFriendRequest']);


    /*/ USTAWIENIA /*/

    Route::get('sources', [SearchController::class, 'test']);

    Route::get('search/{query}', [SearchController::class, 'index']);

    Route::get('verify', [VerificationController::class, 'index']);
    Route::patch('verify', [VerificationController::class, 'update']);

    Route::get('tvshows/detalis/{id}', [TVShowsController::class, 'show']);
    Route::get('tvshows/discover/{page}', [TVShowsController::class, 'index']);
    Route::get('tvshows/sliders/', [TVShowsController::class, 'getPopular']);

    Route::get('sliders/{type}', [SlidersController::class, 'index']);

    Route::get('notifications', [NotificationController::class, 'index']);
    Route::post('notification', [NotificationController::class, 'store']);
    Route::patch('notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::post('notifications/mark-all-read', [NotificationController::class, 'markAllRead']);

    Route::get('movies/discover/{page}', [MoviesController::class, 'index']);
    Route::get('movies/sliders/', [MoviesController::class, 'getPopular']);
    Route::get('movies/detalis/{id}', [MoviesController::class, 'show']);

    Route::post('movies', [MoviesController::class, 'store']);


});
Route::fallback(function () {
    return abort(404);
});

Route::get('grab/getMovieList', [MoviesController::class, 'getGrabMovieList']);
Route::get('grab/getMovie', [MoviesController::class, 'getGrabMovie']);
Route::get('grab/getMoviePoster', [MoviesController::class, 'getGrabMoviePoster']);
Route::get('grab/test', [MoviesController::class, 'test']);

Route::get('stream', [StreamController::class, 'index']);
Route::get('streamts', [StreamController::class, 'createStreamTS']);

Route::get('streammp4', [StreamController::class, 'createStreamMP44']);
Route::get('streamtest', [StreamController::class, 'play']);
Route::get('streamtestt', [StreamController::class, 'testujemy']);

Route::group(['middleware' => 'guest:api'], function () {

    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);

    Route::post('oauth/{driver}', [OAuthController::class, 'redirect']);
    Route::get('oauth/{driver}/callback', [OAuthController::class, 'handleCallback'])->name('oauth.callback');
});
