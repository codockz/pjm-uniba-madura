<?php

namespace App\Http\Controllers\frontend\akreditasi\Mekanisme;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MekanismeAkreditasi;
use App\Models\ContentFooter;

class MekanismePengajuanAkreditasiController extends Controller
{
    public function index()
    {
        $data = MekanismeAkreditasi::orderBy('nama_penyelenggara')->get();
        $content_footer = ContentFooter::first();
        return view('frontend.akreditasi_unb.mekanisme.mekanisme_pengajuan', compact('data','content_footer'));
    }
}
