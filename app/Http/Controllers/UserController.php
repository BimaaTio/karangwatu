<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\News;
use App\Models\User;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userForAdmin = User::where('roles', 'user')->orderBy('roles', 'asc')->get();
        $userForSa  = User::orderBy('created_at', 'desc')->get();
        if (Auth::user()->roles == 'superAdmin') {
            return view('pages.superAdmin.users.index', compact('userForSa'));
        } elseif (Auth::user()->roles == 'admin') {
            return view('pages.admin.users.index', compact('userForAdmin'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed', 
            'roles' => 'required'
        ], [
            'name.required' => 'Kolom Nama wajib diisi!',
            'email.required' => 'Kolom Nama wajib diisi!',
            'email.unique' => 'Email sudah terdaftar!',
            'password.required' => 'Kolom Password wajib diisi!',
            'password.confirmed' => 'Konfirmasi Password tidak cocok!'
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'roles' => $request->roles
            ]);

            if (Auth::user()->roles == 'admin') {
                return redirect()->route('users.index')->with('success', 'Data user berhasil ditambahkan');
            } elseif (Auth::user()->roles == 'superAdmin') {
                return redirect()->route('sa.users.index')->with('success', 'Data user berhasil ditambahkan');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data user');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::user()->roles == 'admin') {
            return view('pages.admin.users.edit', [
                'data' => $user
            ]);
        } elseif (Auth::user()->roles == 'superAdmin') {
            return view('pages.superAdmin.users.edit', [
                'data' => $user
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required',
        ];

        if ($request->email != $user->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }
        $validated = $request->validate($rules, [
            'name.required' => 'Kolom Nama wajib diisi!',
            'email.required' => 'Kolom Nama wajib diisi!',
            'email.unique' => 'Email sudah terdaftar!',
        ]);
        $validate['email'] = $request->email;
        if (Auth::user()->roles == 'superAdmin') {
            $validate['roles'] = $request->roles;
        } else if (Auth::user()->roles == 'admin') {
            $validate['roles'] = 'user';
        }

        try {
            User::where('id', $user->id)->update($validated);
            if (Auth::user()->roles == 'superAdmin') {
                return redirect()->route('sa.users.index')->with('success', 'Berhasil Mengubah Data!');
            } elseif (Auth::user()->roles == 'admin') {
                return redirect()->route('users.index')->with('success', 'Berhasil Mengubah Data!');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Data gagal diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $dataNews = News::where('user_id', $user->id)->get();
        $dataGaleri = Galeri::where('user_id', $user->id)->get();

        if ($dataNews->count() > 0) {
            foreach ($dataNews as $news) {
                Storage::delete($news->foto);
                $news->delete();
            }
        }

        if ($dataGaleri->count() > 0) {
            foreach ($dataGaleri as $galeri) {
                Storage::delete($galeri->foto);
                $galeri->delete();
            }
        }

        $user->delete();
        if (Auth::user()->roles == 'admin') {
            return redirect()->route('users.index')->with('success', 'Berhasil Menghapus Data!');
        } else if (Auth::user()->roles == 'superAdmin') {
            return redirect()->route('sa.users.index')->with('success', 'Berhasil Menghapus Data!');
        }
    }

    public function profile(User $user)
    {
        $user = $admin = User::findOrFail(Auth::user()->id);
        return view('pages.profile', compact('user'));
    }
}
