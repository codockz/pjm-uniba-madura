<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanHasilSurvei extends Model
{
    protected $table = 'laporan_survei';

    protected $fillable = ['judul', 'tahun', 'gambar', 'file_pdf'];
}
