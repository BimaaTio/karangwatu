<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateGaleriRequest;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $kategori = Kategori::where('slug', 'slider')->first();
            $validated = $request->validate([
                'kategori_id' => 'required',
                'judul' => 'required',
                'foto' => 'image|file|max:5120'
            ]);

            $validated['user_id'] = auth()->user()->id;
            $validated['url'] = $request->url;
            $validated['slug'] = Str::slug($request->judul);
            $validated['body'] = $request->judul;
            $validated['status'] = 'published';

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $validated['foto'] = $file->store('slider');
            }

            if ($request->kategori_id == $kategori->id) {
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
        } catch (\Exception $e) {
            // Tangani kesalahan di sini
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $slider   = Galeri::where('slug', $slug)->first();
        return view('pages.admin.slider.edit', [
            'data' => $slider,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Galeri $galeri)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $slider = Galeri::where('slug', $slug)->first();
        if ($slider->foto == true) {
            Storage::delete($slider->foto);
        }
        $slider->delete();
        return redirect('/dashboard/admin/slider')->with('success', 'Data berhasil dihapus!');
    }
}
