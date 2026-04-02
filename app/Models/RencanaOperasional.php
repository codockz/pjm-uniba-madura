<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaOperasional extends Model
{
    use HasFactory;

    protected $table = 'rencana_operasional';

    protected $fillable = ['judul', 'file'];
}
