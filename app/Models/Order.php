<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $fillable = [
        'sewa_perangkat_id',
        'perangkat_id',
        'jumlah',
        'harga'
    ];

    public function perangkat()
    {
        return $this->belongsTo(Perangkat::class);
    }
}
