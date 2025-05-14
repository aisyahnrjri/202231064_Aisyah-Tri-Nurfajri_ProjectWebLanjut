<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Tarif;
use Illuminate\Http\Request;

class pelangganController extends Controller
{
    public function index(Request $request)
    {
        $query = Pelanggan::query();

        if ($request->has('search') && $request->search) {
            $query->where('nama_pelanggan', 'like', '%' . $request->search . '%')
                ->orWhere('nomor_kwh', 'like', '%' . $request->search . '%');
        }

        $pelanggan = $query->with('tarif')->paginate(10);
        $tarifs = Tarif::all();

        return view('dashboard/pelanggan-management/pelanggan-management', ['pelanggans' => $pelanggan, 'tarifs' => $tarifs]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => ['required', 'max:50'],
            'username' => ['required', 'min:5', 'max:50'],
            'password' => ['required', 'min:5', 'max:20'],
            'nomor_kwh' => ['required'],
            'alamat' => ['required'],
            'id_tarif' => 'required|exists:tarif,id_tarif',
        ], [
            'password.min' => 'Kata sandi minimal harus 5 karakter.',
            'password.max' => 'Kata sandi minimal harus 20 karakter.',
            'username.min' => 'Username minimal harus 5 karakter.',
            'username.max' => 'Username minimal harus 50 karakter.',
            'nama_pelanggan.max' => 'Nama maximal harus 50 karakter.',
            'nama_pelanggan.required' => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'id_tarif.required' => 'Level wajib diisi.',
            'nomor_kwh.required' => 'Nomor KWH wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        Pelanggan::create($validated);

        return redirect('/pengaturan-pelanggan')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function put($id)
    {
        $data = Pelanggan::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => ['required', 'max:50'],
            'password' => ['nullable', 'min:5', 'max:20'],
            'alamat' => ['required'],
            'id_tarif' => 'required|exists:tarif,id_tarif',
        ], [
            'password.min' => 'Kata sandi minimal harus 5 karakter.',
            'password.max' => 'Kata sandi minimal harus 20 karakter.',
            'nama_pelanggan.max' => 'Nama maximal harus 50 karakter.',
            'nama_pelanggan.required' => 'Nama wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'id_tarif.required' => 'Level wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $save = Pelanggan::where('id_pelanggan', $request->id_pelanggan)
            ->update($validated);
        if ($save) {
            return redirect()->route('pelanggan-management.index')->with('success', 'Data berhasil diubah.');
        }
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan-management.index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
