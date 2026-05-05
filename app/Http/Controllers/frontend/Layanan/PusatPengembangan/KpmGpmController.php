<?php

namespace App\Http\Controllers\frontend\Layanan\PusatPengembangan;

use App\Models\KpmGpm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentFooter;

class KpmGpmController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->tahun;
        $content_footer = ContentFooter::first();
        $query = KpmGpm::where('is_active', 1);

        // filter tahun (kalau dipilih)
        if ($tahun) {
            $query->where('tahun', $tahun);
        }

        // sorting terbaru
        $data = $query->orderBy('tahun', 'desc')->latest()->get();
        if ($request->ajax()) {
            return response()->json($data);
        }

        // ambil list tahun untuk dropdown
        $listTahun = KpmGpm::select('tahun')->whereNotNull('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        return view('frontend.layanan.pusat_pengembangan_mutu.kpm_gpm', compact('data', 'listTahun', 'tahun','content_footer'));
    }
}
