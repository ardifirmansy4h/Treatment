<?php

namespace App\Http\Controllers;

use App\Models\Jam;
use App\Models\Jenis;
use App\Models\Pendaftaran;
use App\Models\Slot;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{

    public function index()
    {
        $data = Pendaftaran::with(['slot.jam', 'jenis'])->get();
        $slot = Slot::all();
        $jenis = Jenis::all();
        return view('pendaftaran.index', compact('data', 'slot', 'jenis'));
    }

    public function store(Request $request)
    {
        //Steepest Ascent Hill Climbing

        // 1. Inisialisi nilai awal
        $slott = Slot::where('id', $request->slot)->first();
        // 2. Cek tabrakan pada nilai awal yang melebihi batas kuota
        $jumlahTabrakan = Pendaftaran::where('slot_id', $slott->id)
            ->count();

        // 3. Cari Solusi Jika Tabrakan atau jadwal sudah penuh
        $allSlot = Slot::all();
        $allPendaftaran = Pendaftaran::all();
        $slotsBelumPenuh = [];

        foreach ($allSlot as $slot) {
            $jumlahPendaftar = $allPendaftaran->where('slot_id', $slot->id)->count();
            if ($jumlahPendaftar < $slot->kuota && $slot->tanggal >= date('Y-m-d')) {
                $slotsBelumPenuh[] = $slot;
            }
        }
        // 4. Kembalikan nilai solusi ke dalam view
        if ($jumlahTabrakan >= $slott->kuota) {
            return redirect()->route('pendaftaran.index')->with([
                'slotBelumPenuh' => $slotsBelumPenuh,
                'algoritma' => 'Kuota di jadwal yang dipilih sudah penuh! Slot alternatif tersedia di tabel bawah !',
            ]);
        }

        $data = [
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'usia' => $request->usia,
            'alamat' => $request->alamat,
            'jenis_id' => $request->jenis,
            'keterangan' => $request->keterangan,
            'dp' => $request->dp,
            'tgl_pembayaran_dp' => $request->tanggal_pembayaran,
            'slot_id' => $request->slot,
            'status' => 1,
        ];
        Pendaftaran::create($data);
        return redirect()->route('pendaftaran.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function selesai(Request $request)
    {
        $data = [
            'tgl_pembayaran_sisa' => $request->tanggal,
            'sisa_pembayaran' => $request->sisa,
            'status' => 2,
        ];
        Pendaftaran::where('id', $request->id)->update($data);
        return redirect()->route('pendaftaran.index')->with('success', 'Data berhasil diubah');
    }


    public function update(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'usia' => $request->usia,
            'alamat' => $request->alamat,
            'jenis_id' => $request->jenis,
            'keterangan' => $request->keterangan,
            'dp' => $request->dp,
            'tgl_pembayaran_dp' => $request->tanggal_pembayaran,
        ];
        Pendaftaran::where('id', $request->id)->update($data);
        return redirect()->route('pendaftaran.index')->with('success', 'Data berhasil diubah');
    }


    public function destroy(string $id)
    {
        Pendaftaran::destroy($id);
        
        return redirect()->route('pendaftaran.index')->with('success', 'Data berhasil dihapus');
    }

    public function prosesStatus()
    {
        $proses = Pendaftaran::with(['slot.jam', 'jenis'])->where('status', 1)->get();
        $selesai = Pendaftaran::with(['slot.jam', 'jenis'])->where('status', 2)->get();
        return view('status.index', compact('proses', 'selesai'));
    }
}
