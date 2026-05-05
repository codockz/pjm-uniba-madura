<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkAkreditasiProdi extends Model
{
    protected $table = 'sk_akreditasi_prodi';

    protected $fillable = ['program_studi', 'jenjang', 'sk_izin_text', 'file_sk_izin', 'akreditasi', 'sk_akreditasi_text', 'file_sk_akreditasi', 'file','berlaku','kadaluarsa'];
}
