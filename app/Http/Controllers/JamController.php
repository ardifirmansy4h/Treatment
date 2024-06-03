<?php

namespace App\Http\Controllers;

use App\Models\Jam;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JamController extends Controller
{

    public function index()
    {
        $data = Jam::all();
        return view('jam.index', compact('data'));
    }


    public function store(Request $request)
    {
        $existingJam = Jam::where('waktu', $request->jam)->first();
        if ($existingJam) {
            return redirect()->route('jam.index')->with('error', 'Data sudah ada');
        }
        $data = [
            'waktu' => $request->jam,
        ];
        Jam::create($data);
        return redirect()->route('jam.index')->with('success', 'Data berhasil ditambahkan');
    }


    public function destroy(string $id)
    {
        $jam = Jam::find($id);
        foreach ($jam->slots as $slot) {
            Pendaftaran::where('slot_id', $slot->id)->delete();
            $slot->delete();
        }
        $jam->forceDelete();
        return redirect()->route('jam.index')->with('success', 'Data berhasil dihapus');
    }


    public function Jadwal()
    {
        $today = Carbon::today();
        $jadwalHariIni = Pendaftaran::with('jenis')->where('status', 1)
            ->whereHas('slot', function ($query) use ($today) {
                $query->whereDate('tanggal', date('Y-m-d'));
            })->with('slot')->get();
        return view('jadwal.hariini', compact('jadwalHariIni'));
    }

    public function SemuaJadwal()
    {
        $data = Pendaftaran::where('status', 1)->with(['slot', 'jenis'])->get();
        return view('jadwal.semua', compact('data'));
    }
}
