<?php

namespace App\Http\Controllers\frontend\Layanan\PusatAudit;

use App\Http\Controllers\Controller;
use App\Models\ContentFooter;
use App\Models\LaporanAmi;

class LaporanAmiController extends Controller
{
    public function index($tahun)
{
    $data = LaporanAmi::where('tahun', $tahun)->get();

    return view('frontend.layanan.pusat_audit.laporan_ami', compact('data', 'tahun'));
}
}
