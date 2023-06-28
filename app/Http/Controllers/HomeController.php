<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('welcome');
    }

    public function admin()
    {
        return view('pages.admin.dashboard');
    }

    public function user()
    {
        return view('pages.user.dashboard');
    }
}
