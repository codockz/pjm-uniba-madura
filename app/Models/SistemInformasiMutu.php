<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SistemInformasiMutu extends Model
{
    use HasFactory;
    protected $table = 'sistem_informasi_mutu';
    protected $fillable = ['nama_penyelenggara', 'singkatan', 'link'];
}
