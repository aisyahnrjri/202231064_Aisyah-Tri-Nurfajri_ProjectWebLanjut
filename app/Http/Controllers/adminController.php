<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class adminController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search') && $request->search) {
            $query->where('nama_admin', 'like', '%' . $request->search . '%');
        }

        $users = $query->with('level')->paginate(10);
        $levels = Level::all();

        return view('dashboard/user-management/user-management', ['users' => $users, 'level' => $levels]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_admin' => ['required', 'max:50'],
            'username' => ['required', 'min:5', 'max:50', Rule::unique('users')->ignore(Auth::guard('admin')->user()->id_user, 'id_user')],
            'password' => ['required', 'min:5', 'max:20'],
            'id_level' => 'required|exists:level,id_level',
        ], [
            'password.min' => 'Kata sandi minimal harus 5 karakter.',
            'password.max' => 'Kata sandi minimal harus 20 karakter.',
            'username.min' => 'Username minimal harus 5 karakter.',
            'username.max' => 'Username minimal harus 50 karakter.',
            'nama_admin.required' => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'id_level.required' => 'Level wajib diisi.',
            'nama_admin.max' => 'Nama maximal harus 50 karakter.',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect('/pengaturan-pengguna')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function put($id)
    {
        $data = User::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_admin' => 'required|max:50',
            'username' => 'required|min:5|max:50',
            'password' => ['nullable', 'min:5', 'max:20'],
            'id_level' => 'required|exists:level,id_level',
        ], [
            'password.min' => 'Kata sandi minimal harus 5 karakter.',
            'password.max' => 'Kata sandi minimal harus 20 karakter.',
            'username.min' => 'Username minimal harus 5 karakter.',
            'username.max' => 'Username minimal harus 50 karakter.',
            'nama_admin.required' => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'id_level.required' => 'Level wajib diisi.',
            'nama_admin.max' => 'Nama maximal harus 50 karakter.',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']); // Hapus atribut password jika tidak diisi
        }

        $save = User::where('id_user', $request->id_user)
            ->update($validated);
        if ($save) {
            return redirect()->route('user-management.index')->with('success', 'Data berhasil diubah.');
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user-management.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
