<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    use HasFactory;
    protected $table = 'denda';
    protected $fillable = [
        'sewa_ruang_id',
        'sewa_perangkat_id',
        'user_id',
        'status',
        'snap_token',
        'grand_total',
    ];
}
