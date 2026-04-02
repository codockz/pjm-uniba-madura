<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpmGpm extends Model
{
    protected $table = 'kpm_gpm';
    protected $fillable = ['judul', 'file'];
}

