<?php

namespace App\Http\Controllers\frontend\dokumenlpm\DokumenInduk;

use App\Http\Controllers\Controller;
use App\Models\RencanaIndukPengembangan;
use App\Models\ContentFooter;


class RencanaIndukPengembanganController extends Controller
{
    public function index()
    {
        $data = RencanaIndukPengembangan::latest()->first();
        $content_footer = ContentFooter::first();
        return view('frontend.dokumen_lpm.dokumen_induk.rencanainduk', compact('data','content_footer'));
    }
}
