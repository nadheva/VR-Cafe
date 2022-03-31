<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;
    protected $table = 'ruang';
    protected $fillable = [
        'kode_ruang',
        'banner',
        'nama',
        'gambar',
        'harga',
        'deskripsi',
        'resepsionis_id'
    ];

    public function resepsionis() 
    {
        return $this->belongsTo(Resepsionis::class, 'resepsionis_id', 'id');
    }
}
