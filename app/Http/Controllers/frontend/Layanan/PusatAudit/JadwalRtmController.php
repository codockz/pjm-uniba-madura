<?php

namespace App\Http\Controllers\frontend\Layanan\PusatAudit;

use App\Models\JadwalRtm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentFooter;

class JadwalRtmController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->tahun;
        $content_footer = ContentFooter::first();
        $query = JadwalRtm::where('is_active', 1);

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
        $listTahun = JadwalRtm::select('tahun')
            ->whereNotNull('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('frontend.layanan.pusat_audit.jadwal_rtm', compact('data', 'listTahun', 'tahun','content_footer'));
    }
}
