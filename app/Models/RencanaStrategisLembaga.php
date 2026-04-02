<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaStrategisLembaga extends Model
{
    protected $table = 'rencana_strategis_lembaga';

    protected $fillable = ['judul', 'file', 'tahun_mulai', 'tahun_selesai'];
}
