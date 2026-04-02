<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedoman extends Model
{
    use HasFactory;
    protected $table = 'pedoman';

    protected $fillable = ['judul', 'tahun_terbit', 'revisi', 'file'];
}
