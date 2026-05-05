<?php

namespace App\Http\Controllers\frontend\dokumenlpm\DokumenInduk;

use App\Models\RencanaOperasional;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentFooter;


class RencanaOperasionalController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->tahun;
        $content_footer = ContentFooter::first();
        $query = RencanaOperasional::where('is_active', 1);

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
        $listTahun = RencanaOperasional::select('tahun')
            ->whereNotNull('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view(
            'frontend.dokumen_lpm.dokumen_induk.rencanaoperasional',
            compact('data', 'listTahun', 'tahun','content_footer')
        );
    }
}
