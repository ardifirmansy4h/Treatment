<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPasien = Pendaftaran::all()->count();
        $belumSelesai = Pendaftaran::where('status', 1)->count();
        $selesai = Pendaftaran::where('status', 2)->count();
        Carbon::setLocale('id');
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $bulanSekarang = Carbon::now()->translatedFormat('F');

        $pendapatanUangMuka = Pendaftaran::whereMonth('tgl_pembayaran_dp', $currentMonth)
            ->whereYear('tgl_pembayaran_dp', $currentYear)
            ->sum('dp');

        $pendapatanSisa = Pendaftaran::whereMonth('tgl_pembayaran_sisa', $currentMonth)
            ->whereYear('tgl_pembayaran_sisa', $currentYear)
            ->sum('sisa_pembayaran');

        $jumlahPendapatan = $pendapatanUangMuka + $pendapatanSisa;
        $formattedJumlahPendapatan = 'Rp ' . number_format($jumlahPendapatan, 0, ',', '.');
        $data = [
            'totalPasien' => $totalPasien,
            'belumSelesai' => $belumSelesai,
            'selesai' => $selesai,
            'bulanSekarang' => $bulanSekarang,
            'jumlahPendapatan' => $formattedJumlahPendapatan,
        ];
        return view('dashboard.index', compact('data'));
    }
}
