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
        'slug',
        'gambar',
        'gambar_detail',
        'harga',
        'jumlah',
        'ukuran',
        'pc_desktop',
        'monitor',
        'perangkat_vr',
        'deskripsi',
        'resepsionis_id'
    ];
    protected $array = ['gambar_detail'];

    public function resepsionis()
    {
        return $this->belongsTo(Resepsionis::class, 'resepsionis_id', 'id');
    }

    public function sewa_ruang()
    {
        return $this->hasMany(SewaRuang::class);
    }
}
