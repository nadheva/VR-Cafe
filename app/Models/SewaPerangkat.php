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
        'grand_total',
    ];

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function denda()
    {
        return $this->hasOne(Denda::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
