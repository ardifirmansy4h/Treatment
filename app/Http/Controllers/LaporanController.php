<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use PDF;


class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function laporanData(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $dataUangMuka = Pendaftaran::whereMonth('tgl_pembayaran_dp', $bulan)
            ->whereYear('tgl_pembayaran_dp', $tahun)
            ->sum('dp');

        $dataPembayaranSisa = Pendaftaran::whereMonth('tgl_pembayaran_sisa', $bulan)
            ->whereYear('tgl_pembayaran_sisa', $tahun)
            ->where('status', 2)
            ->sum('sisa_pembayaran');

        $dataAllUangMuka = Pendaftaran::whereMonth('tgl_pembayaran_dp', $bulan)
            ->whereYear('tgl_pembayaran_dp', $tahun)
            ->get();

        $dataAllPembayaranSisa = Pendaftaran::whereMonth('tgl_pembayaran_sisa', $bulan)
            ->whereYear('tgl_pembayaran_sisa', $tahun)
            ->where('status', 2)
            ->get();

        $totalPendapatanReal = $dataUangMuka + $dataPembayaranSisa;

        function formatRupiah($angka)
        {
            return 'Rp' . number_format($angka, 0, ',', '.');
        }

        $totalPendapatan = formatRupiah($totalPendapatanReal);

        $namaBulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $namaBulanIndonesia = $namaBulan[(int)$bulan];

        $data = [
            'dataUangMuka' => $dataUangMuka,
            'dataPembayaranSisa' => $dataPembayaranSisa,
            'totalPendapatan' => $totalPendapatan,
            'dataAllUangMuka' => $dataAllUangMuka,
            'dataAllPembayaranSisa' => $dataAllPembayaranSisa,
            'bulan' => $namaBulanIndonesia,
            'tahun' => $tahun,
        ];

        return view('laporan.laporan-search', compact('data'));
    }

    public function cetak($id)
    {
        $data = Pendaftaran::findOrFail($id);
        return view('laporan.cetak', compact('data'));
    }
}
