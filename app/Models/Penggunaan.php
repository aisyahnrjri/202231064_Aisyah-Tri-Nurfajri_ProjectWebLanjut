<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggunaan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_penggunaan';
    protected $fillable = [
        'id_pelanggan',
        'bulan',
        'tahun',
        'meter_awal',
        'meter_akhir'
    ];

    protected $table = 'penggunaan';

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }
}
