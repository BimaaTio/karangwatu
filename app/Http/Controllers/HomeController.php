<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $berita = News::where('status', 'published')->with(['user', 'kategori'])->latest()->paginate(6);
        return view('asd', [
            'berita' => $berita
        ]);
    }

    public function superAdmin()
    {
        return view('pages.superAdmin.dashboard');
    }

    public function admin()

    {
        return view('pages.admin.dashboard');
    }

    public function user()
    {
        $kategori = Kategori::all();
        return view('pages.user.dashboard', [
            'kategori' => $kategori,
        ]);
    }
}
