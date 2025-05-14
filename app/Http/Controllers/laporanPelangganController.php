<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class laporanPelangganController extends Controller
{
    public function index(Request $request)
    {
        $query = Pelanggan::query();

        if ($request->has('search') && $request->search) {
            $query->where('nama_pelanggan', 'like', '%' . $request->search . '%')
                ->orWhere('nomor_kwh', 'like', '%' . $request->search . '%');
        }

        $pelanggan = $query->with('tarif')->paginate(10);

        return view('dashboard/laporan-pelanggan/laporan-pelanggan', ['pelanggans' => $pelanggan]);
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

        // Data
        $query = Pelanggan::query();

        $pelanggan = $query->with('tarif')->get(); // get() digunakan untuk mengambil koleksi data
        $row = 2;

        foreach ($pelanggan as $data) {
            $sheet->setCellValue('A' . $row, $data->nama_pelanggan);
            $sheet->setCellValue('B' . $row, $data->nomor_kwh);
            $sheet->setCellValue('C' . $row, $data->alamat);
            $sheet->setCellValue('D' . $row, $data->tarif->daya);
            $row++;
        }

        // Set header for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="pelanggan.xlsx"');
        header('Cache-Control: max-age=0');

        // Create Excel file and download
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
