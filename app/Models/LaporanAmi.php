<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanAmi extends Model
{
    protected $table = 'laporan_ami';

    protected $fillable = ['judul', 'tahun', 'cover', 'file'];
}
