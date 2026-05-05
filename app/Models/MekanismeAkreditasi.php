<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MekanismeAkreditasi extends Model
{
    use HasFactory;
    protected $table = 'mekanisme_akreditasi';
    protected $fillable = ['nama_penyelenggara', 'singkatan', 'link'];
}
