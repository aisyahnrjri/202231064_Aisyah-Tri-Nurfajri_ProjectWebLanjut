<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoUserController extends Controller
{

    public function create()
    {
        return view('dashboard/user-profile/user-profile');
    }

    public function store(Request $request)
    {

        $attributes = request()->validate([
            'nama_admin' => ['required', 'max:50'],
            'password' => ['nullable', 'min:5', 'max:20']
        ]);

        if (!empty($attributes['password'])) {
            $attributes['password'] = bcrypt($attributes['password']);
        } else {
            unset($attributes['password']);
        }

        User::where('id_user', Auth::guard('admin')->user()->id_user)
            ->update($attributes);


        return redirect('/user-profile')->with('success', 'Profil berhasil diubah.');
    }
}
