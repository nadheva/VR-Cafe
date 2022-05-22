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
        'sewa_studio_id',
        'user_id',
        'invoice',
        'grand_total',
    ];

    public function sewa_perangkat(){
        return $this->belongsTo(SewaPerangkat::class);
    }

    public function sewa_studio(){
        return $this->belongsTo(SewaStudio::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
