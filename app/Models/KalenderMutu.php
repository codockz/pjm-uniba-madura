<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KalenderMutu extends Model
{
    protected $table = 'kalender_mutu';

    protected $fillable = [
        'tahun',
        'judul',
        'file'
    ];
}
