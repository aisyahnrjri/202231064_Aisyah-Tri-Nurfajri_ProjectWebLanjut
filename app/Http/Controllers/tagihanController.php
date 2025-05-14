<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Xendit\Configuration;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\Invoice\InvoiceApi;

class tagihanController extends Controller
{

    public function __construct()
    {
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));
    }

    public function index(Request $request)
    {
        $query = Pelanggan::query();

        if ($request->has('search') && $request->search) {
            $query->where('nama_pelanggan', 'like', '%' . $request->search . '%')
                ->orWhere('nomor_kwh', 'like', '%' . $request->search . '%');
        }

        $pelanggan = $query->with('tarif')->paginate(10);

        $tagihans = Tagihan::with('pelanggan')->get();

        return view('dashboard/tagihan-management/tagihan-management', ['penggunaans' => $pelanggan, 'tagihans' => $tagihans]);
    }

    public function show(Request $request, $id)
    {
        $query = Tagihan::where('id_pelanggan', $id);

        if ($request->has('search') && $request->search) {
            $query->where('bulan', 'like', '%' . $request->search . '%')
                ->orWhere('tahun', 'like', '%' . $request->search . '%');
        }

        $penggunaans = $query->with('pelanggan')->paginate(10);

        $tarif = Pelanggan::findOrFail($id)->tarif->tarifperkwh;

        $tagihan = Tagihan::where('id_pelanggan', $id)->where('status', 'pending')->sum('jumlah_meter');

        $totalTagihan = $tarif * $tagihan;
        
        $pelanggan = Pelanggan::findOrFail($id);

        return view('dashboard/tagihan-management/detail-tagihan-management', ['penggunaans' => $penggunaans, 'pelanggan' => $pelanggan, 'totalTagihan' => $totalTagihan, 'tarif' => $tarif]);
    }

    public function store(Request $request)
    {
        $createInvoice = new CreateInvoiceRequest([
            'external_id' => 'INV-' . rand(),
            'amount' => $request->tagihan + 2000,
            'success_redirect_url' => "http://localhost:8000/detail-tagihan-listrik/$request->id_pelanggan"
        ]);

        $apiInstance = new InvoiceApi();
        $generateInvoice = $apiInstance->createInvoice($createInvoice);

        Tagihan::where('id_tagihan', $request->id_tagihan)->update(['status' => 'Sudah dibayar']);

        $pembayaran = [
            'id_tagihan' => $request->id_tagihan,
            'id_pelanggan' => $request->id_pelanggan,
            'tanggal_pembayaran' => now(),
            'bulan_bayar' => now()->format('F'),
            'biaya_admin' => 2000,
            'total_bayar' => $request->tagihan + 2000,
            'id_user' => $request->id_user
        ];

        Pembayaran::create($pembayaran);

        return redirect($generateInvoice['invoice_url'])->with('success', 'Pembayaran berhasil.');
    }

    public function generateInvoice($id)
    {
        $pembayaran = Pembayaran::with(['pelanggan', 'tagihan'])->where('id_tagihan', $id)->first();
    
        return view('dashboard/tagihan-management/invoice', ['pembayaran' => $pembayaran, 'total_bayar' => $pembayaran->total_bayar]);
    }
}
