<?php

namespace App\Http\Controllers\frontend\Layanan\PusatPengembangan;

use App\Models\SuratTugasMonev;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentFooter;

class SuratTugasMonevController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->tahun;
        $content_footer = ContentFooter::first();
        $query = SuratTugasMonev::where('is_active', 1);

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

        // 🔽 ambil list tahun untuk dropdown
        $listTahun = SuratTugasMonev::select('tahun')->whereNotNull('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        return view('frontend.layanan.pusat_pengembangan_mutu.surat_tugas_monev', compact('data', 'listTahun', 'tahun','content_footer'));
    }
}
