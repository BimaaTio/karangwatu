<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Event;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::whereNotIn('nama', ['slider'])->orderBy('nama', 'asc')->get();
        $acara    = Event::orderBy('updated_at', 'desc')->with(['user', 'kategori'])->get();
        return view('pages.admin.event.index', [
            'kategori' => $kategori,
            'data' => $acara
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
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        $namaAcara = Event::where('slug', $request->nama_acara);
        $validate = $request->validate([
            'kategori_id' => 'required',
            'nama_acara' => 'required',
            'waktu_acara' => 'required',
            'deskripsi' => 'required|min:20',
            'foto' => 'image|file|max:5120'
        ]);

        if ($request->nama_acara == $namaAcara) {
            return redirect('/dashboard/admin/news')->with('error', 'Gagal Membuat Berita, Judul Sudah Terpakai!');
            exit;
        } else {
            $validate['slug'] = Str::slug($request->nama_acara);
        }
        $validate['user_id'] = auth()->user()->id;
        $validate['status'] = 'draft';
        if ($request->file('foto')) {
            $validate['foto'] = $request->file('foto')->store('acara');
        }
        Event::create($validate);
        return redirect()->route('acara.index')->with('success', 'Berhasil Membuat Acara!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $kategori = Kategori::whereNotIn('nama', ['slider'])->orderBy('nama', 'asc')->get();
        $event = Event::where('slug', $slug)->first();
        return view('pages.admin.event.edit', [
            'data' => $event,
            'kategori' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $rules = [
            'kategori_id' => 'required',
            'nama_acara' => 'required',
            'waktu_acara' => 'required',
            'deskripsi' => 'required|min:20',
            'foto' => 'image|file|max:5120'
        ];

        // Cek apakah slug berubah
        if ($request->judul != $event->judul) {
            $rules['slug'] = 'unique:events';
        }

        $validate = $request->validate($rules);

        if ($request->file('foto')) {
            if ($request->oldFoto) {
                Storage::delete($request->oldFoto);
            }
            $validate['foto'] = $request->file('foto')->store('acara');;
        } else {
            $validate['foto'] = $request->oldFoto;
        }

        $validate['status'] = $request->status;
        $validate['waktu_acara'] = $request->waktu_acara;
        // Perbarui slug jika judul berubah
        if ($request->judul != $event->judul) {
            $validate['slug'] = Str::slug($request->judul);
        }

        // Perbarui data acara
        Event::where('id', $request->id)->update($validate);
        return redirect()->route('acara.index')->with('success', 'Berhasil Mengubah Acara!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $acara = Event::where('slug', $slug)->first();
        Storage::delete($acara->foto);
        $acara->delete();
        return redirect('/dashboard/admin/acara')->with('success', 'Data berhasil dihapus!');
    }
}
