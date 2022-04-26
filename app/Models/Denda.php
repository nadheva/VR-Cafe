<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    use HasFactory;
    protected $table = 'denda';
    protected $fillable = [
        'sewa_perangkat_id',
        'user_id',
        'invoice',
        'status',
        'snap_token',
        'grand_total',
    ];

    public function sewa_perangkat(){
        return $this->belongsTo(SewaPerangkat::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
