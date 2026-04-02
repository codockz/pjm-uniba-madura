<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesorBKD extends Model
{
    use HasFactory;

    protected $table = 'asesor_b_k_d_s'; 

    protected $fillable = ['nama_dosen', 'nira', 'program_studi_id', 'periode'];
    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class);
    }
}
