<?php

namespace App\Http\Controllers\frontend\Layanan\PusatPengembangan;

use App\Http\Controllers\Controller;
use App\Models\SuratTugasMonev;

class SuratTugasMonevController extends Controller
{
    public function index()
    {
        $data = SuratTugasMonev::latest()->get();

        return view('frontend.layanan.pusat_pengembangan_mutu.surat_tugas_monev', compact('data'));
    }
}
