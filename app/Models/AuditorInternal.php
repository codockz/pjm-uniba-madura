<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditorInternal extends Model
{
    protected $table = 'auditor_internal';

    protected $fillable = ['nama', 'fakultas'];
}
