<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\Event;
use App\Models\Galeri;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $slideId = Kategori::where('nama', 'Slider')->pluck('id');
        $galeri = Galeri::where('status', 'published')
        ->whereNotIn('kategori_id', $slideId)
            ->whereNull('url')
            ->with(['user', 'kategori'])
            ->paginate(8)
            ->items();

        $slider =
            Galeri::orderBy('updated_at', 'desc')
            ->with(['user', 'kategori'])
            ->where('status', 'published')
            ->whereHas('kategori', function ($query) {
                $query->where('nama', 'Slider');
            })->get();
        $berita = News::where('status', 'published')->with(['user', 'kategori'])->latest()->paginate(6);
        $acara  = Event::where('status', 'published')->with(['user', 'kategori'])->latest()->paginate(6); 
        return view('index', [
            'berita' => $berita,
            'galeri' => $galeri,
            'slider' => $slider,
            'acara' => $acara,
        ]);
    }

    public function superAdmin()
    {
        $user = User::all();
        return view('pages.superAdmin.dashboard');
    }

    public function admin()

    {
        $acara = Event::all();
        $berita = News::all();
        $galeri = Galeri::all();
        $user = User::all();
        return view('pages.admin.dashboard', compact('acara', 'berita', 'galeri', 'user'));
    }

    public function user()
    {
        $berita = News::where('user_id', Auth::user()->id)->get();
        $galeri = Galeri::where('user_id', Auth::user()->id)->get();
        return view('pages.user.dashboard', compact('berita', 'galeri'));
    }
}
