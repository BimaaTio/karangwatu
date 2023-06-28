<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserNewsController;

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
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth','checkRole:admin']], function (){
    Route::get('/dashboard/admin', [HomeController::class, 'admin'])->name('dashboard.admin');
    Route::resource('/dashboard/admin/users', UserController::class);
    Route::resource('/dashboard/admin/news', NewsController::class);
});
Route::group(['middleware' => ['auth','checkRole:user']], function (){
    Route::get('/dashboard/user', [HomeController::class, 'user'])->name('dashboard.user');
    Route::resource('/dashboard/user/news', NewsController::class)->names('user.news');
});
