<?php

namespace App\Http\Controllers;

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
        return view('index');
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
