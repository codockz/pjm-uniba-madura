<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalRtm extends Model
{
    protected $table = 'jadwal_rtm';
    protected $fillable = ['judul', 'tahun', 'cover', 'file'];
}
