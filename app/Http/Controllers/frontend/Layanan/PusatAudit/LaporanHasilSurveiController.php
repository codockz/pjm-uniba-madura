<?php

namespace App\Http\Controllers\frontend\Layanan\PusatAudit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanHasilSurvei;

class LaporanHasilSurveiController extends Controller
{
    public function index($tahun)
    {
        $data = LaporanHasilSurvei::where('tahun', $tahun)->get();

        return view('frontend.layanan.pusat_audit.laporan_hasil_survei', compact('data', 'tahun'));
    }
}
