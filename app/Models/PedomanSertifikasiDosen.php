<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedomanSertifikasiDosen extends Model
{
    use HasFactory;

    protected $table = 'pedoman_sertifikasi_dosen';

    protected $fillable = [
    'label',
    'judul',
    'file',
    'urutan',
    'is_active',
];
}

