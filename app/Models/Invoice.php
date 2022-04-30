<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoice';
    protected $fillable = [
        'ruang_id',
        'user_id',
        'tipe',
        'invoice',
        'tanggal_mulai',
        'tanggal_berakhir',
        'keperluan',
        'denda',
        'proses',
        'status',
        'snap_token',
        'grand_total'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }


}
