<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanAmi extends Model
{
    use HasFactory;

    protected $table = 'laporan_ami';

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
