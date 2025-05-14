<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tarif;
use Illuminate\Http\Request;

class tarifController extends Controller
{
    public function index(Request $request)
    {
        $query = Tarif::query();

        if ($request->has('search') && $request->search) {
            $query->where('daya', 'like', '%' . $request->search . '%');
        }

        $tarif = $query->paginate(10);

        return view('dashboard/tarif-management/tarif-management', ['tarif' => $tarif]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'daya' => ['required', 'max:15'],
            'tarifperkwh' => ['required', 'max:11'],
        ], [
            'daya.required' => 'Daya wajib diisi.',
            'daya.max' => 'Daya maximal harus 15 karakter.',
            'tarifperkwh.required' => 'Tarif wajib diisi.',
            'tarifperkwh.max' => 'Tarif maximal harus 11 karakter.',
        ]);

        Tarif::create($validated);

        return redirect('/pengaturan-tarif')->with('success', 'Tarif berhasil ditambahkan.');
    }

    public function put($id)
    {
        $data = Tarif::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'daya' => ['required', 'max:15'],
            'tarifperkwh' => ['required', 'max:11'],
        ], [
            'daya.required' => 'Daya wajib diisi.',
            'daya.max' => 'Daya maximal harus 15 karakter.',
            'tarifperkwh.required' => 'Tarif wajib diisi.',
            'tarifperkwh.max' => 'Tarif maximal harus 11 karakter.',
        ]);

        $save = Tarif::where('id_tarif', $request->id_tarif)
            ->update($validated);
        if ($save) {
            return redirect('/pengaturan-tarif')->with('success', 'Data berhasil diubah.');
        }
    }

    public function destroy($id)
    {
        $tarif = Tarif::findOrFail($id);
        $tarif->delete();

        return redirect()->route('tarif-management.index')->with('success', 'Tarif berhasil dihapus.');
    }
}
