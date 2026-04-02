<?php

namespace App\Http\Controllers\frontend\Layanan\PusatAudit;

use App\Http\Controllers\Controller;
use App\Models\ContentFooter;
use Illuminate\Http\Request;
use App\Models\SertifikasiDosen;

class SertifikasiDosenController extends Controller

{
    public function index()
{
    $data = SertifikasiDosen::orderBy('tahun','desc')->get();

    return view('frontend.layanan.pusat_audit.sertifikasi_dosen', compact('data'));
}

}
