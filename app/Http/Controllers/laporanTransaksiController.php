<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class laporanTransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Tagihan::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('pelanggan', function ($q) use ($search) {
                $q->where('nama_pelanggan', 'like', '%' . $search . '%')->orWhere('nomor_kwh', 'like', '%' . $search . '%');
            });
        }

        $tagihan = $query->with('pelanggan')->paginate(10);

        return view('dashboard/laporan-transaksi/laporan-transaksi', ['tagihans' => $tagihan]);
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Data header
        $sheet->setCellValue('A1', 'Nama Pelanggan');
        $sheet->setCellValue('B1', 'Nomor KWH');
        $sheet->setCellValue('C1', 'Alamat');
        $sheet->setCellValue('D1', 'Daya');
        $sheet->setCellValue('E1', 'Bulan');
        $sheet->setCellValue('F1', 'Tahun');
        $sheet->setCellValue('G1', 'Total Tagihan');
        $sheet->setCellValue('H1', 'status');

        // Data
        $query = Tagihan::query();

        $pelanggan = $query->with('pelanggan')->get();
        $row = 2;

        foreach ($pelanggan as $data) {
            $sheet->setCellValue('A' . $row, $data->pelanggan->nama_pelanggan);
            $sheet->setCellValue('B' . $row, $data->pelanggan->nomor_kwh);
            $sheet->setCellValue('C' . $row, $data->pelanggan->alamat);
            $sheet->setCellValue('D' . $row, $data->pelanggan->tarif->daya);
            $sheet->setCellValue('E' . $row, $data->bulan);
            $sheet->setCellValue('F' . $row, $data->tahun);
            $sheet->setCellValue('G' . $row, $data->jumlah_meter * $data->pelanggan->tarif->tarifperkwh);
            $sheet->setCellValue('H' . $row, $data->status);
            $row++;
        }

        // Set header for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="transaksi.xlsx"');
        header('Cache-Control: max-age=0');

        // Create Excel file and download
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
