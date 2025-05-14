<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_level';
    protected $fillable = [
        'nama_level',
    ];

    protected $table = 'level';

    // Relasi ke tabel users (opsional jika dibutuhkan)
    public function users()
    {
        return $this->hasMany(User::class, 'id_level');
    }
}
