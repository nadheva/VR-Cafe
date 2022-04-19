<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SewaPerangkat extends Model
{
    use HasFactory;
    protected $table = 'sewa_perangkat';
    protected $fillable = [
        'user_id',
        'invoice',
        'tanggal_mulai',
        'tanggal_berakhir',
        'keperluan',
        'proses',
        'status',
        'snap_token',
        'grand_total'
    ];
}
