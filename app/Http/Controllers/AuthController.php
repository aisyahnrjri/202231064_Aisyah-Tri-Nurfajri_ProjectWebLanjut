<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create()
    {
        return view('authGuest.login-session');
    }
    public function store()
    {
        $attributes = request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('pelanggan')->attempt($attributes)) {
            session()->regenerate();
            return redirect('dashboard-pelanggan')->with(['success' => 'Berhasil Masuk.']);
        } else {
            return back()->withErrors(['username' => 'Username atau Password salah.']);
        }
    }

    public function destroy()
    {

        Auth::guard('pelanggan')->logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/login')->with(['success' => 'Kamu baru saja keluar.']);
    }
}
