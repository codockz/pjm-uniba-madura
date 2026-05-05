<?php

namespace App\Http\Controllers\frontend\Layanan\PusatAudit;

use App\Models\KalenderAkademik;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentFooter;

class KalenderAkademikController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->tahun;
        $content_footer = ContentFooter::first();
        $query = KalenderAkademik::where('is_active', 1);

        // 🔽 filter tahun
        if ($tahun) {
            $query->where('tahun', $tahun);
        }

        // 🔽 sorting terbaru
        $data = $query->orderBy('tahun', 'desc')->latest()->get();

        // 🔥 AJAX
        if ($request->ajax()) {
            return response()->json($data);
        }

        // 🔽 list tahun
        $listTahun = KalenderAkademik::select('tahun')
            ->whereNotNull('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('frontend.layanan.pusat_audit.kalender_akademik', compact('data', 'listTahun', 'tahun','content_footer'));
    }
}
