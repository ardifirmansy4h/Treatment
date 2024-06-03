<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Jenis;
use App\Models\Pendaftaran;

class JenisController extends Controller
{
    public function index()
    {
        $data = Jenis::all();
        return view('jenis.index', compact('data'));
    }

    public function store(Request $request)
    {

        $data = [
            'nama' => $request->nama
        ];
        Jenis::create($data);
        return redirect()->route('jenis.index')->with('success', 'Data berhasil ditambah !');
    }

    public function destroy(String $id)
    {
        $jenis = Jenis::find($id);
        Pendaftaran::where('jenis_id', $id)->delete();
        $jenis->delete();
        return redirect()->route('jenis.index')->with('success', 'Data berhasil dihapus');
    }
}
