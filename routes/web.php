<?php

use App\Models\News;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route Berita Home {
Route::get('/berita', [NewsController::class, 'home'])->name('berita');
Route::get('/berita/{news:slug}', [NewsController::class, 'show'])->name('berita.show');
Route::get('/berita/author/{user:name}', function (User $user) {
    $username = ucwords($user->name);
    return view('pages.home.berita', [
        'title' => "Berita Post By : $username",
        'user' => $user,
        'berita' => $user->news->where('status', 'published')
    ]);
});
Route::get('/berita/kategori/{kategori:slug}', function (Kategori $kategori) {
    return view('pages.home.berita', [
        'title' => "Berita Dengan Kategori : $kategori->nama",
        'kategori' => $kategori,
        'berita' => $kategori->news->where('status', 'published')
    ]);
})->name('berita.kategori.show');
Route::get('/kategori/berita', [KategoriController::class, 'home'])->name('berita.kategori');
// }End Route Berita Home

Route::get('/kategori/galeri', [KategoriController::class, 'kategoriGaleri'])->name('galeri.kategori');
Route::get('/galeri', [GaleriController::class, 'home'])->name('galeri');


Route::get('/home', [HomeController::class, 'index']);
// Route Dashboard {
// dashboard Super admin
Route::group(['middleware' => ['auth', 'checkRole:superAdmin']], function () {
    Route::get('/dashboard/sa', [HomeController::class, 'superAdmin'])->name('dashboard.sa');
    Route::resource('/dashboard/sa/users', UserController::class)->names('sa.users');
    Route::get('/dashboard/sa/profile', [ProfileController::class, 'edit'])->name('sa.profile.edit');
    Route::patch('/dashboard/admin/profile', [ProfileController::class, 'update'])->name('sa.profile.update');
});
// Dashboard admin
Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    Route::get('/dashboard/admin', [HomeController::class, 'admin'])->name('dashboard.admin');
    Route::resource('/dashboard/admin/users', UserController::class);
    Route::resource('/dashboard/admin/news', NewsController::class);
    Route::resource('/dashboard/admin/kategori', KategoriController::class);
    Route::resource('/dashboard/admin/galeri', GaleriController::class);
    Route::resource('/dashboard/admin/slider', SliderController::class);
    Route::resource('/dashboard/admin/acara', EventController::class);
    Route::get('/dashboard/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/dashboard/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');

});
// Dashboard User
Route::group(['middleware' => ['auth', 'checkRole:user']], function () {
    Route::get('/dashboard/user', [HomeController::class, 'user'])->name('dashboard.user');
    Route::resource('/dashboard/user/news', NewsController::class)->names('user.news');
    Route::resource('/dashboard/user/kategori', KategoriController::class)->names('user.kategori');
    Route::resource('/dashboard/user/galeri', GaleriController::class)->names('user.galeri');
    Route::get('/dashboard/user/profile', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::patch('/dashboard/admin/profile', [ProfileController::class, 'update'])->name('user.profile.update');

});
// End Dashboard Route }