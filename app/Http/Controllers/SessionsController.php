<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($attributes)) {
            session()->regenerate();
            return redirect('dashboard')->with(['success' => 'Berhasil Masuk.']);
        } else {

            return back()->withErrors(['username' => 'Username atau Password salah.']);
        }
    }

    public function destroy()
    {

        Auth::guard('admin')->logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/login-admin')->with(['success' => 'Kamu baru saja keluar.']);
    }
}
