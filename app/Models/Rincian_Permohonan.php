<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rincian_Permohonan extends Model
{
    use HasFactory;
    protected $table = 'rincian_premohonans';
    protected $fillable = [
        'id_permohonan',
        'id_persyaratan',
        'entry_data',
        'upload_data'
    ];

    public function pemohonan()
    {
        return $this->belongsTo(Pemohonan::class, 'id_permohonan', 'id');
    }

    public function persyaratan()
    {
        return $this->belongsTo(Persyaratan::class, 'id_persyaratan', 'id');
    }
}
