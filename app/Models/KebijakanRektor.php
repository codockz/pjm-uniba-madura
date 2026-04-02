<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KebijakanRektor extends Model
{
    use HasFactory;
    protected $fillable = ['tahun', 'nomor', 'dokumen', 'tentang', 'tanggal_terbit', 'file'];
}
