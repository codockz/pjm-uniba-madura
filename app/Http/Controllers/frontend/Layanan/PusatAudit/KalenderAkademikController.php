<?php

namespace App\Http\Controllers\frontend\Layanan\PusatAudit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentFooter;
use App\Models\KalenderAkademik;

class KalenderAkademikController extends Controller
{
    public function index($tahun)
    {
        $data = KalenderAkademik::where('tahun', $tahun)->first();

        return view('frontend.layanan.pusat_audit.kalender_akademik', compact('data', 'tahun'));
    }
}
