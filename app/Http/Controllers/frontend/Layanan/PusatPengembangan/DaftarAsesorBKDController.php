<?php

namespace App\Http\Controllers\frontend\Layanan\PusatPengembangan;

use App\Http\Controllers\Controller;
use App\Models\AsesorBkd;
use App\Models\ContentFooter;

class DaftarAsesorBKDController extends Controller
{
    public function index()
    {
        $data = AsesorBkd::with('programStudi')->latest()->get();
        $content_footer = ContentFooter::first();

        return view('frontend.layanan.pusat_pengembangan_mutu.daftar_asesor_bkd', compact('data','content_footer'));
    }
}
