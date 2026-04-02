<?php

namespace App\Http\Controllers\Frontend\Layanan\PusatAudit;

use App\Http\Controllers\Controller;
use App\Models\KalenderMutu;

class KalenderMutuController extends Controller
{
    public function index($tahun)
{
    $data = KalenderMutu::where('tahun', $tahun)->get();

    return view('frontend.layanan.pusat_audit.kalender_mutu', compact('data', 'tahun'));
}
}
