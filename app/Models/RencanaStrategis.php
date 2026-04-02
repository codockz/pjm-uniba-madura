<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaStrategis extends Model
{
    use HasFactory;

    protected $table = 'rencana_strategis';

    protected $fillable = [
        'judul',
        'tahun_mulai',
        'tahun_berakhir',
        'file',
    ];
}
