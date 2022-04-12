<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profile';
    protected $fillable = [
        'user_id',
        'nama_depan',
        'nama_belakang',
        'nik',
        'no_telp',
        'facebook',
        'instagram',
        'foto',
        'alamat',
        'kota',
        'provinsi',
        'kode_pos'
    ];

    public function  user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
