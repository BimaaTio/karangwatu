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
        $kategori = Kategori::whereNotIn('nama', ['slider'])->orderBy('nama', 'asc')->get();
        $kategoriSliderIds = Kategori::where('nama', 'Slider')->pluck('id');
        $galeriForAdmin = Galeri::orderBy('updated_at', 'desc')
        ->with(['user', 'kategori'])
        ->whereNotIn('kategori_id', $kategoriSliderIds)
            ->get();
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

    public function slider()
    {
        $kategori = Kategori::where('slug', 'slider')->first();
        $slider = Galeri::orderBy('updated_at', 'desc')
        ->with(['user', 'kategori'])
        ->whereHas('kategori', function ($query) {
            $query->where('nama', 'Slider');
        })->get();

        return view('pages.admin.slider.index', [
            'data' => $slider,
            'kategori' => $kategori
        ]);
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
        $kategori = Kategori::where('slug', 'slider')->first();
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

        if (
            $request->kategori_id == $kategori->id
        ) {
            Galeri::create($validated);
            return redirect('/dashboard/admin/slider')->with('success', 'Berhasil Menguplod!');
        } else {
            Galeri::create($validated);
            if (Auth::user()->roles == 'admin') {
                return redirect('/dashboard/admin/galeri')->with('success', 'Berhasil Menguplod!');
            } elseif (Auth::user()->roles == 'user') {
                return redirect('/dashboard/user/galeri')->with('success', 'Berhasil Menguplod!');
            }
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


        if ($request->url) {
            $validate['url'] = $request->url;
            Galeri::where('id', $galeri->id)->update(['foto' => NULL]);
        }


        if (!$request->file('foto') && !$request->url) {
            $validate['foto'] = $request->oldFoto;
        } else {
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

    public function home()
    {
        $slideId = Kategori::where('nama', 'Slider')->pluck('id');
        $data = Galeri::where('status', 'published')
        ->whereNotIn('kategori_id', $slideId)
            ->get();
        return view('pages.home.galeri', [
            'title' => 'Semua Foto / Vidio',
            'data' => $data
        ]);
    }
}
