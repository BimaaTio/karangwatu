<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::orderBy('created_at', 'desc')->get();
        if (Auth::user()->roles == 'admin') {
            return view('pages.admin.kategori.index', [
                'kategori' => $kategori
            ]);
        } elseif (Auth::user()->roles == 'user') {
            return view('pages.user.kategori.index', [
                'kategori' => $kategori
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKategoriRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKategoriRequest $request)
    {
        $validate = $request->validate([
            'nama' => 'required'
        ]);
        $validate['slug'] = Str::slug($request->nama);

        Kategori::create($validate);

        if (Auth::user()->roles == 'admin') {
            return redirect('/dashboard/admin/kategori')->with('success', 'Berhasil Membuat Kategori!');
        } elseif (Auth::user()->roles == 'user') {
            return redirect('/dashboard/user/kategori')->with('success', 'Berhasil Membuat Kategori!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {

        return view('pages.home.single.single-kategori', [
            'kategori' => $kategori,
            'berita' => $kategori->news

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $data = Kategori::where('slug', $slug)->first();
        if (Auth::user()->roles == 'admin') {
            return view('pages.admin.kategori.edit', [
                'data' => $data
            ]);
        } else if (Auth::user()->roles == 'user') {
            return view('pages.user.kategori.edit', [
                'data' => $data
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKategoriRequest  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKategoriRequest $request, Kategori $kategori)
    {
        $rules = $request->validate([]);

        if ($request->slug != $kategori->slug) {
            $rules['slug'] = 'unique:news';
        }

        $validate = $request->validate($rules);
        $validate['nama'] = $request->nama;
        $validate['slug'] = Str::slug($request->nama);
        Kategori::where('id', $kategori->id)->update($validate);
        if (Auth::user()->roles == 'admin') {
            return redirect('/dashboard/admin/kategori')->with('success', 'Berhasil Mengubah Kategori!');
        } elseif (Auth::user()->roles == 'user') {
            return redirect('/dashboard/user/kategori')->with('success', 'Berhasil Mengubah Kategori!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        //
    }

    public function home()
    {
        return view('pages.home.kategori-berita', [
            'title' => 'Semua Kategori',
            'kategori' => Kategori::whereNotIn('nama', ['slider'])
                ->orderBy('nama', 'asc')
                ->get(),
            'berita' => News::where('status', 'published')->latest()->paginate(6),
        ]);
    }

    public function kategoriGaleri()
    {
        return view('pages.home.kategori-galeri', [
            'title' => 'Semua Kategori',
            'kategori' => Kategori::orderByDesc('created_at')->get(),

        ]);
    }
}
