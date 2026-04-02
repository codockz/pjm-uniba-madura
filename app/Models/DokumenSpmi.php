<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenSpmi extends Model
{
    use HasFactory;
    protected $table = 'dokumen_spmi';
    protected $fillable = ['judul', 'link', 'gambar', 'deskripsi'];
}
