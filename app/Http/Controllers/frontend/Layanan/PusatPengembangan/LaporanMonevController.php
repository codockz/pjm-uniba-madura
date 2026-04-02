<?php

namespace App\Http\Controllers\frontend\Layanan\PusatPengembangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanMonev;


class LaporanMonevController extends Controller
{
    public function index()
{

    $data = LaporanMonev::orderBy('tahun', 'desc')->get();

    return view('frontend.layanan.pusat_pengembangan_mutu.laporan_monev', compact('data',));
}
}
