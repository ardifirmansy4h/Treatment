<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;
    protected $table = 'slot';
    protected $fillable = [
        'tanggal',
        'jam_id',
        'kuota',
    ];

    public function jam()
    {
        return $this->belongsTo(Jam::class, 'jam_id');
    }
    
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
