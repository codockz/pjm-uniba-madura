<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaOperasional extends Model
{
    use HasFactory;

    protected $table = 'rencana_operasional';

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
