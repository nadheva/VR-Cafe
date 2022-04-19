<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perangkat extends Model
{
    use HasFactory;
    protected $table = 'perangkat';
    protected $fillable = [
    'kode_perangkat',
    'nama',
    'slug',
    'gambar',
    'gambar_detail',
    'stok',
    'harga',
    'deskripsi'
    ];
    protected $array = ['gambar_detail'];
}
