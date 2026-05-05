<?php

namespace App\Http\Controllers\frontend\dokumenlpm\DokumenMutu;

use App\Models\Sop;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentFooter;


class SopController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->tahun;
        $content_footer = ContentFooter::first();
        $query = Sop::where('is_active', 1);

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
        $listTahun = Sop::select('tahun')
            ->whereNotNull('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('frontend.dokumen_lpm.dokumen_mutu.sop', compact('data', 'listTahun', 'tahun','content_footer'));
    }
}
