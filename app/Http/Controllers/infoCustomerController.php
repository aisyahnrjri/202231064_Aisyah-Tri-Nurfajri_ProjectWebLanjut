<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class infoCustomerController extends Controller
{
    public function create()
    {
        return view('customer/profil/user-profile');
    }

    public function store(Request $request)
    {

        $attributes = request()->validate([
            'nama_pelanggan' => ['required', 'max:50'],
            'password' => ['nullable', 'min:5', 'max:20'],
            'alamat' => ['required']
        ]);

        if (!empty($attributes['password'])) {
            $attributes['password'] = bcrypt($attributes['password']);
        } else {
            unset($attributes['password']);
        }
        
        Pelanggan::where('id_pelanggan',Auth::guard('pelanggan')->user()->id_pelanggan)
        ->update($attributes);


        return redirect('/profile')->with('success','Profil berhasil diubah.');
    }
}
