<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payment';
    protected $fillable = [
        'invoice',
        'status',
        'snap_token',
        'grand_total'
    ];

    public function sewa_perangkat()
    {
        return $this->belongsTo(SewaPerangkat::class, 'sewa_perangkat_id', 'id');
    }
    public function sewa_ruang()
    {
        return $this->belongsTo(SewaRuang::class, 'sewa_ruang_id', 'id');
    }
}
