<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkreditasiInstitusi extends Model
{
    protected $table = 'akreditasi_institusi';

    protected $fillable = ['nama_pt', 'peringkat', 'nomor_sk', 'tahun_sk', 'tgl_berlaku', 'tgl_kadaluarsa', 'file'];
}
