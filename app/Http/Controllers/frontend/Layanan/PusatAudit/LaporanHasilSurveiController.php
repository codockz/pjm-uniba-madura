<?php

namespace App\Http\Controllers\frontend\Layanan\PusatAudit;

use App\Models\LaporanHasilSurvei;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentFooter;

class LaporanHasilSurveiController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->tahun;
        $content_footer = ContentFooter::first();
        $query = LaporanHasilSurvei::where('is_active', 1);

        // 🔽 filter tahun
        if ($tahun) {
            $query->where('tahun', $tahun);
        }

        // 🔽 sorting terbaru
        $data = $query->orderBy('tahun', 'desc')->latest()->get();

        // 🔥 AJAX (buat filter tanpa reload)
        if ($request->ajax()) {
            return response()->json($data);
        }

        // 🔽 list tahun untuk dropdown
        $listTahun = LaporanHasilSurvei::select('tahun')->whereNotNull('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        return view('frontend.layanan.pusat_audit.laporan_hasil_survei', compact('data', 'listTahun', 'tahun','content_footer'));
    }
}
