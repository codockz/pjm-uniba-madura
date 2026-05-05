<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasiGambar extends Model
{
    use HasFactory;
    protected $table = 'struktur_organisasi_gambar';

    protected $fillable = ['gambar'];
}
