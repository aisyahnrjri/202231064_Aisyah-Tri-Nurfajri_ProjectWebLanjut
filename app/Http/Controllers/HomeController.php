<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        return redirect('/login');
    }

    public function index()
    {
        $earningToday = Pembayaran::where('tanggal_pembayaran', Carbon::today())->sum('total_bayar');
        $earningYesterday = Pembayaran::where('tanggal_pembayaran', Carbon::yesterday())->sum('total_bayar');
        
        $totalPenghasilan = Pembayaran::sum('total_bayar');

        $totalPenghasilanYesterday = Pembayaran::where('tanggal_pembayaran', '<=', Carbon::yesterday())->sum('total_bayar');

        $percentageChangeTotal = 0;

        if ($totalPenghasilanYesterday > 0) {
            $percentageChangeTotal = round((($totalPenghasilan - $totalPenghasilanYesterday) / $totalPenghasilanYesterday) * 100);
        }
        
        $totalUsers = User::count();

        $totalPelanggan = Pelanggan::count();
        
        $percentageChange = 0;

        if ($earningYesterday > 0) {
            $percentageChange = (($earningToday - $earningYesterday) / $earningYesterday) * 100;
        }

        return view('dashboard', ['earningToday' => $earningToday, 'percentageEarning' => $percentageChange, 'totalUsers' => $totalUsers, 'totalPelanggan' => $totalPelanggan, 'totalPenghasilan' => $totalPenghasilan, 'percentageChangeTotal' => $percentageChangeTotal]);
    }

    public function indexPelanggan() {
        $tagihan = Tagihan::where('status', 'pending')->where('id_pelanggan', Auth::guard('pelanggan')->user()->id_pelanggan)->count();

        $tagihanAll = Tagihan::where('status', 'pending')->where('id_pelanggan', Auth::guard('pelanggan')->user()->id_pelanggan)->sum('jumlah_meter');
        $tarifPelanggan = Pelanggan::where('id_pelanggan', Auth::guard('pelanggan')->user()->id_pelanggan)->first();

        $totalTagihan = $tagihanAll * $tarifPelanggan->tarif->tarifperkwh;

        return view('customer/dashboard', ['tagihan' => $tagihan, 'totalTagihan' => $totalTagihan]);
    }
}
