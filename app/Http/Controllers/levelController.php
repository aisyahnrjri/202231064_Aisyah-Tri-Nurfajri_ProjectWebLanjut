<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;

class levelController extends Controller
{
    public function index(Request $request)
    {
        $query = Level::query();

        if ($request->has('search') && $request->search) {
            $query->where('nama_level', 'like', '%' . $request->search . '%');
        }

        $level = $query->paginate(10);

        return view('dashboard/level-management/level-management', ['level' => $level]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_level' => ['required', 'max:50'],
        ], [
            'nama_level.required' => 'Nama wajib diisi.',
            'nama_level.max' => 'Nama maximal harus 50 karakter.',
        ]);

        Level::create($validated);

        return redirect('/pengaturan-level')->with('success', 'Level berhasil ditambahkan.');
    }

    public function put($id){
        $data = Level::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_level' => 'required|max:50',
        ], [
            'nama_level.required' => 'Nama wajib diisi.',
            'nama_level.max' => 'Nama maximal harus 50 karakter.',
        ]);

        $save = level::where('id_level', $request->id_level)
            ->update($validated);
        if ($save) {
            return redirect('/pengaturan-level')->with('success', 'Data berhasil diubah.');
        }
    }

    public function destroy($id)
    {
        $user = level::findOrFail($id);
        $user->delete();

        return redirect()->route('level-management.index')->with('success', 'Level berhasil dihapus.');
    }
}
