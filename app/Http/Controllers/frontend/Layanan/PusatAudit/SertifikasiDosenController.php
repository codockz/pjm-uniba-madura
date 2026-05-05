<?php

namespace App\Http\Controllers\frontend\Layanan\PusatAudit;

use App\Http\Controllers\Controller;
use App\Models\ContentFooter;
use Illuminate\Http\Request;
use App\Models\SertifikasiDosen;
use App\Models\PedomanSertifikasiDosen;

class SertifikasiDosenController extends Controller

{
    public function index()
{
    // 🔽 tabel bawah (yang lama)
    $data = SertifikasiDosen::orderBy('tahun','desc')->get();
    $content_footer = ContentFooter::first();

    // 🔽 pedoman (yang baru)
    $pedoman = PedomanSertifikasiDosen::where('is_active', 1)
                ->orderBy('urutan')
                ->get();

    return view('frontend.layanan.pusat_audit.sertifikasi_dosen', compact('data', 'pedoman','content_footer'));
}
}
