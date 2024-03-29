<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', [\App\Http\Controllers\PostController::class, 'index']);
#Route::get('{post}', [\App\Http\Controllers\PostController::class, 'show']); # eviter les collision au niveau des routes
Route::get('/email', [\App\Http\Controllers\UserEmailController::class, 'index']);
Route::post('/email', [\App\Http\Controllers\UserEmailController::class, 'process_email'])->name('email');

Route::get('/login', \Auth0\Laravel\Http\Controller\Stateful\Login::class)->name('login');
Route::get('/logout', \Auth0\Laravel\Http\Controller\Stateful\Logout::class)->name('logout');
Route::get('/auth0/callback', \Auth0\Laravel\Http\Controller\Stateful\Callback::class)->name('auth0.callback');

Route::get('/', function () {
    if (Auth::check()) {
        return view('auth0.user');
    }

    return view('auth0/guest');
})->middleware(['auth0.authenticate.optional']);

// Require an authenticated session to access this route.
Route::get('/required', function () {
    return view('auth0.user');
})->middleware(['auth0.authenticate']);


