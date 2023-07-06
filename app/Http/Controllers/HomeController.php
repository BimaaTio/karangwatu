<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Galeri;
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
        $slideId = Kategori::where('nama', 'Slider')->pluck('id');
        $galeri =
            Galeri::where('status', 'published')
            ->whereNotIn('kategori_id', $slideId)
            ->with(['user', 'kategori'])
            ->get();
        $slider =
            Galeri::orderBy('updated_at', 'desc')
            ->with(['user', 'kategori'])
            ->where('status', 'published')
            ->whereHas('kategori', function ($query) {
                $query->where('nama', 'Slider');
            })->get();
        $berita = News::where('status', 'published')->with(['user', 'kategori'])->latest()->paginate(6);
        return view('index', [
            'berita' => $berita,
            'galeri' => $galeri,
            'slider' => $slider,
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
