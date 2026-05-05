<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaStrategisLembaga extends Model
{
    use HasFactory;

    protected $table = 'rencana_strategis_lembaga';

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
