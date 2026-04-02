<?php

namespace App\Http\Controllers\frontend\Layanan\PusatPengembangan;

use App\Http\Controllers\Controller;
use App\Models\AsesorBkd;

class DaftarAsesorBKDController extends Controller
{
    public function index()
    {
        $data = AsesorBkd::with('programStudi')->latest()->get();

        return view('frontend.layanan.pusat_pengembangan_mutu.daftar_asesor_bkd', compact('data'));
    }
}
