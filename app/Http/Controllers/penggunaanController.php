<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Penggunaan;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class penggunaanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pelanggan::query();

        if ($request->has('search') && $request->search) {
            $query->where('nama_pelanggan', 'like', '%' . $request->search . '%')
                ->orWhere('nomor_kwh', 'like', '%' . $request->search . '%');
        }

        $pelanggan = $query->with('tarif')->paginate(10);

        $tagihans = Tagihan::with('pelanggan')->get();

        return view('dashboard/penggunaan-management/penggunaan-management', ['penggunaans' => $pelanggan, 'tagihans' => $tagihans]);
    }

    public function show(Request $request, $id)
    {
        $query = Penggunaan::where('id_pelanggan', $id);

        if ($request->has('search') && $request->search) {
            $query->where('bulan', 'like', '%' . $request->search . '%')
                ->orWhere('tahun', 'like', '%' . $request->search . '%');
        }

        $pelanggan = Pelanggan::findOrFail($id);

        $lastMeterAkhir = Penggunaan::where('id_pelanggan', $id)
        ->orderBy('id_penggunaan', 'desc')
        ->value('meter_akhir');

        $penggunaans = $query->with('pelanggan')->paginate(10);

        return view('dashboard/penggunaan-management/detail-penggunaan-management', ['penggunaans' => $penggunaans, 'pelanggan' => $pelanggan, 'meterAkhir' => $lastMeterAkhir]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'bulan' => ['required'],
            'tahun' => ['required'],
            'meter_awal' => ['required'],
            'meter_akhir' => ['required'],
        ], [
            'id_pelanggan.required' => 'id pelanggan wajib diisi.',
            'bulan.required' => 'Bulan wajib diisi.',
            'tahun.required' => 'Tahun wajib diisi.',
            'meter_awal.required' => 'Meter Awal wajib diisi.',
            'meter_akhir.required' => 'Meter Akhir wajib diisi.'
        ]);

        $penggunaan = Penggunaan::create($validated);

        $jumlah_meter = $validated['meter_akhir'] - $validated['meter_awal'];

        if ($jumlah_meter < 0) {
            return back()->with('failed', 'Meter akhir tidak boleh lebih kecil dari meter awal.');
        }

        $validatedTagihan = [
            'id_penggunaan' => $penggunaan->id_penggunaan,
            'id_pelanggan' => $validated['id_pelanggan'],
            'bulan' => $validated['bulan'],
            'tahun' => $validated['tahun'],
            'jumlah_meter' => $jumlah_meter,
            'status' => 'pending',
        ];

        Tagihan::create($validatedTagihan);

        return redirect("/detail-penggunaan-listrik/$request->id_pelanggan")->with('success', 'Penggunaan berhasil ditambahkan.');
    }

    public function put($id)
    {
        $data = Penggunaan::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'bulan' => ['required'],
            'tahun' => ['required', 'max:4'],
            'meter_awal' => ['required'],
            'meter_akhir' => ['required'],
        ], [
            'tahun.max' => 'Tahun maxsimal harus 4 karakter.',
            'bulan.required' => 'Bulan wajib diisi.',
            'tahun.required' => 'Tahun wajib diisi.',
            'meter_awal.required' => 'Meter Awal wajib diisi.',
            'meter_akhir.required' => 'Meter Akhir wajib diisi.',
        ]);

        $save = Penggunaan::where('id_penggunaan', $request->id_penggunaan)
            ->update($validated);
        if ($save) {
            return redirect("/detail-penggunaan-listrik/$request->id_pelanggan")->with('success', 'Data berhasil diubah.');
        }
    }
}
