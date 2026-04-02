<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveiPemangku extends Model
{
    use HasFactory;
    protected $table = 'survei_pemangku';
    protected $fillable = [
        'pengisi',
        'kepuasan_text',
        'link_kepuasan',
        'evaluasi_text',
        'link_evaluasi'
    ];
}
