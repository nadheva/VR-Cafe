<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SewaStudio extends Model
{
    use HasFactory;
    protected $table = 'sewa_studio';
    protected $fillable = [
        'studio_id',
        'user_id',
        'invoice',
        'tanggal_mulai',
        'tanggal_berakhir',
        'keperluan',
        'proses',
        'grand_total',
        'approval'
    ];

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id', 'id');
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
