<?php

namespace App\Http\Controllers\frontend\dokumenlpm\DokumenInduk;

use App\Models\RencanaStrategis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentFooter;


class RencanaStrategisController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->tahun;
        $content_footer = ContentFooter::first();
        $query = RencanaStrategis::where('is_active', 1);

        // 🔽 filter tahun
        if ($tahun) {
            $query->where('tahun', $tahun);
        }

        // 🔽 sorting terbaru
        $data = $query->orderBy('tahun', 'desc')->latest()->get();

        // 🔥 untuk DataTables AJAX
        if ($request->ajax()) {
            return response()->json($data);
        }

        // 🔽 list tahun untuk dropdown
        $listTahun = RencanaStrategis::select('tahun')->whereNotNull('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        return view('frontend.dokumen_lpm.dokumen_induk.rencanastrategis', compact('data', 'listTahun', 'tahun','content_footer'));
    }
}
