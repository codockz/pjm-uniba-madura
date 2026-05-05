<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasiDeskripsi extends Model
{
    use HasFactory;
    protected $table = 'struktur_organisasi_deskripsi';

    protected $fillable = ['urutan', 'judul', 'deskripsi'];
}
