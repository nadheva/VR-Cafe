<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;
    protected $table = 'studio';
    protected $fillable = [
        'kode_studio',
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

    public function sewa_studio()
    {
        return $this->hasMany(SewaStudio::class);
    }
}
