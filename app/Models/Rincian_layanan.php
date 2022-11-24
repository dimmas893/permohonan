<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rincian_layanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_layanan',
        'id_persyaratan'
    ];
    protected $table = 'rincian_layanan';

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id');
    }

    public function persyaratan()
    {
        return $this->belongsTo(Persyaratan::class, 'id_persyaratan', 'id');
    }
}
