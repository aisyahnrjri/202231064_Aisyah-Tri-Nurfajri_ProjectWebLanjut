<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Tarif;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        $tarifs = Tarif::all();
        return view('authGuest.register', ['tarifs' => $tarifs]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'nama_pelanggan' => ['required', 'max:50'],
            'username' => ['required', 'min:5', 'max:50', Rule::unique('pelanggan', 'username')],
            'password' => ['required', 'min:5', 'max:20'],
            'alamat' => ['required'],
            'id_tarif' => ['required'],
            'agreement' => ['accepted']
        ], [
            'password.min' => 'Kata sandi minimal harus 5 karakter.',
            'password.max' => 'Kata sandi minimal harus 20 karakter.',
            'username.min' => 'Username minimal harus 5 karakter.',
            'username.max' => 'Username minimal harus 50 karakter.',
            'nama_pelanggan.required' => 'Nama wajib diisi.',                
            'username.required' => 'Username wajib diisi.',                
            'password.required' => 'Password wajib diisi.',                
            'nama_pelanggan.max' => 'Nama minimal harus 50 karakter.',                 
            'alamat.required' => 'Alamat wajib diisi.',                 
            'id_tarif.required' => 'Tarif wajib diisi.',                 
        ]);

        $attributes['nomor_kwh'] = date('YmdHis');
        $attributes['password'] = bcrypt($attributes['password']);

        session()->flash('success', 'Akun berhasil dibuat.');
        $pelanggan = Pelanggan::create($attributes);
        Auth::guard('pelanggan')->login($pelanggan);
        return redirect('/dashboard-pelanggan');
    }
}
