<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;
    protected $table = 'pendaftarans';
    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'usia',
        'alamat',
        'jenis_id',
        'keterangan',
        'dp',
        'tgl_pembayaran_dp',
        'sisa_pembayaran',
        'tgl_pembayaran_sisa',
        'slot_id',
        'status',
    ];
    public function slot()
    {
        return $this->belongsTo(Slot::class, 'slot_id');
    }

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }
}
