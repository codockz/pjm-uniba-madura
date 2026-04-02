<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanMonev extends Model
{
    protected $fillable = ['judul', 'tahun', 'file'];
    protected $table = 'laporan_monevs';
}
