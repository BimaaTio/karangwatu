<?php

namespace App\Http\Controllers;

use SweetAlert;
use App\Models\News;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreNewsRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateNewsRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();
        $newsForAdmin = News::orderBy('updated_at', 'desc')->with(['user', 'kategori'])->get();
        $newsForUser = News::where('user_id', Auth::user()->id)->get();
        if(Auth::user()->roles == 'admin'){
            return view('pages.admin.news.index', [
                'data' => $newsForAdmin,
                'kategori' => $kategori
            ]);
        } elseif(Auth::user()->roles == 'user'){
            return view('pages.user.news.index', [
                'data' => $newsForUser,
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
     * @param  \App\Http\Requests\StoreNewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsRequest $request)
    {
        // return $request->file('foto')->store('news-images');

        $validate = $request->validate([
            'kategori_id' => 'required',
            'judul' => 'required',
            'body' => 'required|min:60',
            'foto' => 'image|file|max:5120'
        ]);

        $validate['user_id'] = auth()->user()->id;
        $validate['slug'] = Str::slug($request->judul);
        $validate['excerpt'] = Str::limit($request->body, 100);
        $validate['status'] = 'draft';

        if ($request->file('foto')) {
            $validate['foto'] = $request->file('foto')->store('news-images');
        }

        News::create($validate);
        if (Auth::user()->roles == 'admin') {
            return redirect('/dashboard/admin/news')->with('success', 'Berhasil Membuat Berita!');
        } elseif (Auth::user()->roles == 'user') {
            return redirect('/dashboard/user/news')->with('success', 'Berhasil Membuat Berita!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $kategori = Kategori::all();
        $news = News::where('slug', $slug)->first();
        return view('pages.admin.news.edit', [
            'data' => $news,
            'kategori' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNewsRequest  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $rules = [
            'kategori_id' => 'required',
            'judul' => 'required',
            'body' => 'required|min:60',
            'foto' => 'image|file|max:5120'

        ];

        if ($request->slug != $news->slug) {
            $rules['slug'] = 'unique:news';
        }

        if ($request->status != $news->status) {
            $validate['status'] = $request->status;
        }
        $validate = $request->validate($rules);

        if ($request->file('foto')) {
            if ($request->oldFoto) {
                Storage::delete($request->oldFoto);
            }
            $validate['foto'] = $request->file('foto')->store('news-images');
        }

        $validate['excerpt'] = Str::limit($request->body, 100);
        $validate['slug'] = Str::slug($request->judul);

        News::where('id', $news->id)->update($validate);
        if (Auth::user()->roles == 'admin') {
            return redirect('/dashboard/admin/news')->with('success', 'Berhasil Mengubah Berita!');
        } elseif (Auth::user()->roles == 'user') {
            return redirect('/dashboard/user/news')->with('success', 'Berhasil Mengubah Berita!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $news = News::where('slug', $slug)->first();
        $news->delete();
        return redirect('/dashboard/admin/news')->with('success', 'Data berhasil dihapus!');
    }
}
