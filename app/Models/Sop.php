<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sop extends Model
{
    protected $fillable = ['judul', 'file', 'deskripsi', 'tahun'];
}
