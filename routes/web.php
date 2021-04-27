<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('home', ['auth_user' => Auth::user()]);
});

Auth::routes();

Route::group(['prefix' => 'presentation', 'middleware' => 'auth'], function () {
    Route::post('/', [App\Http\Controllers\PresentationController::class, 'store']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/presentation', [App\Http\Controllers\PresentationController::class, 'index'])->name('presentation');
Route::get('/presentation/{link}', [App\Http\Controllers\PresentationController::class, 'show'])->name('show');

Route::post('/presentation-offer', [App\Http\Controllers\PresentationController::class, 'makeStreamOffer']);
Route::post('/presentation-answer', [App\Http\Controllers\PresentationController::class, 'makeStreamOffer']);