<?php

namespace App\Http\Controllers\frontend\Layanan\PusatPengembangan;

use App\Models\LaporanMonev;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentFooter;

class LaporanMonevController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->tahun;
        $content_footer = ContentFooter::first();
        $query = LaporanMonev::where('is_active', 1);

        // 🔽 filter tahun
        if ($tahun) {
            $query->where('tahun', $tahun);
        }

        // 🔽 sorting terbaru
        $data = $query->orderBy('tahun', 'desc')->latest()->get();

        // 🔥 AJAX response
        if ($request->ajax()) {
            return response()->json($data);
        }

        // 🔽 list tahun untuk dropdown
        $listTahun = LaporanMonev::select('tahun')->whereNotNull('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        return view('frontend.layanan.pusat_pengembangan_mutu.laporan_monev', compact('data', 'listTahun', 'tahun','content_footer'));
    }
}
