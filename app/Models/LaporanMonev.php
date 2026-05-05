<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanMonev extends Model
{
    use HasFactory;

    protected $table = 'laporan_monev';

    protected $fillable = [
        'judul',
        'tahun',
        'file',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'tahun' => 'integer',
    ];
}
