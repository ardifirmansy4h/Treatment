<?php

namespace App\Http\Controllers;

use App\Models\Jam;
use App\Models\Slot;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class SlotController extends Controller
{

    public function index()
    {
        $data = Slot::all();
        $jam  = Jam::all();
        return view('slot.index', compact('data', 'jam'));
    }

    public function store(Request $request)
    {
        $existingSlot = Slot::where('tanggal', $request->tanggal)
            ->where('jam_id', $request->jam)
            ->first();

        if ($existingSlot) {
            return redirect()->route('slot.index')->with('error', 'Data dengan tanggal dan jam yang sama sudah ada');
        }

        $data = [
            'jam_id' => $request->jam,
            'kuota' => $request->kuota,
            'tanggal' => $request->tanggal,
        ];
        Slot::create($data);
        return redirect()->route('slot.index')->with('success', 'Data berhasil ditambahkan');
    }
    public function destroy(string $id)
    {
        Pendaftaran::where('slot_id', $id)->delete();
        Slot::destroy($id);
        return redirect()->route('slot.index')->with('success', 'Data berhasil dihapus');
    }

}
