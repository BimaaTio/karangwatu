<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if (Auth::user()->roles == 'superAdmin') {
            return view('pages.superAdmin.profile', [
                'data' => $request->user()
            ]);
        } elseif (Auth::user()->roles == 'admin') {
            return view('pages.admin.profile', [
                'data' => $request->user()
            ]);
        } else if (Auth::user()->roles == 'user') {
            return view('pages.user.profile', [
                'data' => $request->user()
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
    public function update(UpdateProfileRequest $request, User $user)
    {
        $rules = [
            'name' => 'required',
        ];

        if ($request->email != $user->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }

        $validate = $request->validate($rules);

        User::where('id', $user->id)->update($validate);
        if (Auth::user()->roles == 'admin') {
            return redirect('/dashboard/admin')->with('success', 'Berhasil Mengupdate Profile!');
        } elseif (Auth::user()->roles == 'user') {
            return redirect('/dashboard/user')->with('success', 'Berhasil Mengupdate Profile!');
        } elseif (Auth::user()->roles == 'superAdmin') {
            return redirect('/dashboard/user')->with('success', 'Berhasil Mengupdate Profile!');
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
        //
    }
}
