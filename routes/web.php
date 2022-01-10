<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\LandingPageController;
use App\Http\Controllers\Front\AtasanFrontController;
use App\Http\Controllers\Front\CelanaFrontController;
use App\Http\Controllers\Front\OuterFrontController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\WebProfileController;
use App\Http\Controllers\Back\AdminProfileController;
use App\Http\Controllers\Back\AtasanController;
use App\Http\Controllers\Back\CelanaController;
use App\Http\Controllers\Back\OuterController;
use App\Http\Controllers\Back\AuthController;

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

Route::resource('/', LandingPageController::class);
Route::resource('atasan', AtasanFrontController::class);
Route::resource('celana', CelanaFrontController::class);
Route::resource('outer', OuterFrontController::class);
Route::resource('dashboard', DashboardController::class);
Route::resource('login', AuthController::class)->middleware('guest');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('dashboard', DashboardController::class);
    Route::resource('admin-profile', AdminProfileController::class);
    Route::resource('web-profile', WebProfileController::class);
    Route::resource('atasan-cms', AtasanController::class);
    Route::resource('celana-cms', CelanaController::class);
    Route::resource('outer-cms', OuterController::class);
});