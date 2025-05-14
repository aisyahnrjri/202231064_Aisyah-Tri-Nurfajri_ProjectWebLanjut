<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pelanggan extends Authenticatable
{
    use HasFactory;
    protected $primaryKey = 'id_pelanggan';
    protected $fillable = [
        'username',
        'password',
        'nomor_kwh',
        'nama_pelanggan',
        'alamat',
        'id_tarif',
    ];

    protected $table = 'pelanggan';

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'id_tarif');
    }

    protected $hidden = ['password', 'remember_token'];

}
