<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreGaleriRequest;
use App\Http\Requests\UpdateGaleriRequest;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::orderBy('nama', 'asc')->get();
        $galeriForAdmin = Galeri::orderBy('updated_at', 'desc')->with(['user', 'kategori'])->get();
        $galeriForUser = Galeri::where('user_id', Auth::user()->id)->get();
        if (Auth::user()->roles == 'admin') {
            return view('pages.admin.galeri.index', [
                'data' => $galeriForAdmin,
                'kategori' => $kategori
            ]);
        } elseif (Auth::user()->roles == 'user') {
            return view('pages.user.galeri.index', [
                'data' => $galeriForUser,
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
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGaleriRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGaleriRequest $request)
    {
        // ddd($request);
        $validated = $request->validate([
            'kategori_id' => 'required',
            'judul' => 'required',
            'body' => 'required',
            'foto' => 'image|file|max:5120'
        ]);

        $validated['user_id'] = auth()->user()->id;
        $validated['url'] = $request->url;
        $validated['slug'] = Str::slug($request->judul);
        $validated['status'] = 'draft';

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $validated['foto'] = $file->store('galeri');
        }

        Galeri::create($validated);
        if (Auth::user()->roles == 'admin') {
            return redirect('/dashboard/admin/galeri')->with('success', 'Berhasil Menguplod!');
        } elseif (Auth::user()->roles == 'user') {
            return redirect('/dashboard/user/galeri')->with('success', 'Berhasil Menguplod!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function show(Galeri $galeri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $kategori = Kategori::orderBy('nama', 'asc')->get();
        $galeri   = Galeri::where('slug', $slug)->first();
        return view('pages.admin.galeri.edit', [
            'data' => $galeri,
            'kategori' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGaleriRequest  $request
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGaleriRequest $request, Galeri $galeri)
    {
        $rules = [
            'kategori_id' => 'required',
            'judul' => 'required',
            'body' => 'required',
            'foto' => 'image|file|max:5120'
        ];

        if ($request->slug != $galeri->slug) {
            $rules['slug'] = 'unique:galeris';
        }

        $validate = $request->validate($rules);


        if (!$request->file('foto')) {
            $validate['url'] = $request->url;
            Galeri::where('id', $galeri->id)->update(['foto' => NULL]);
            Storage::delete($request->oldFoto);
        }

        if ($request->file('foto')) {
            if ($request->oldFoto) {
                Storage::delete($request->oldFoto);
            }
            $validate['foto'] = $request->file('foto')->store('galeri');
            Galeri::where('id', $galeri->id)->update(['url' => NULL]);
        }

        $validate['slug'] = Str::slug($request->judul);
        $validate['status'] = $request->status;
        Galeri::where('id', $galeri->id)->update($validate);
        if (Auth::user()->roles == 'admin') {
            return redirect('/dashboard/admin/galeri')->with('success', 'Berhasil Mengubah Data Galeri!');
        } elseif (Auth::user()->roles == 'user') {
            return redirect('/dashboard/user/galeri')->with('success', 'Berhasil Mengubah Data Galeri!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $galeri = Galeri::where('slug', $slug)->first();
        if ($galeri->foto == true) {
            Storage::delete($galeri->foto);
        }
        $galeri->delete();
        return redirect('/dashboard/admin/galeri')->with('success', 'Data berhasil dihapus!');
    }
}
