<?php

use App\Models\News;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GaleriController;
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

Route::get('/', function () {
    $berita = News::where('status', 'published')->with(['user', 'kategori'])->latest()->paginate(6);
    return view('index', [
        'berita' => $berita
    ]);
})->name('home');

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


Route::get('/home', [HomeController::class, 'index']);
// Route Dashboard {
// dashboard Super admin
Route::group(['middleware' => ['auth', 'checkRole:superAdmin']], function () {
    Route::get('/dashboard/sa', [HomeController::class, 'superAdmin'])->name('dashboard.sa');
    Route::resource('/dashboard/sa/users', UserController::class)->names('sa.users');
});
// Dashboard admin
Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    Route::get('/dashboard/admin', [HomeController::class, 'admin'])->name('dashboard.admin');
    Route::resource('/dashboard/admin/users', UserController::class);
    Route::resource('/dashboard/admin/news', NewsController::class);
    Route::resource('/dashboard/admin/kategori', KategoriController::class);
    Route::resource('/dashboard/admin/galeri', GaleriController::class);
});
// Dashboard User
Route::group(['middleware' => ['auth', 'checkRole:user']], function () {
    Route::get('/dashboard/user', [HomeController::class, 'user'])->name('dashboard.user');
    Route::resource('/dashboard/user/news', NewsController::class)->names('user.news');
});
// End Dashboard Route }
