<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalAmi extends Model
{
    protected $table = 'jadwal_ami';

    protected $fillable = ['judul', 'tahun', 'cover', 'file'];
}
