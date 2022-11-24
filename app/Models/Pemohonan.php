<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemohonan extends Model
{
    use HasFactory;
    protected $table = 'pemohonans';
    protected $fillable = [
        'id_permohonan',
        'id_layanan',
        'id_pemohon',
        'id_user',
        'tanggal'
    ];

    public function pemohon()
    {
        return $this->belongsTo(Pemohon::class, 'id_pemohon', 'id');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
