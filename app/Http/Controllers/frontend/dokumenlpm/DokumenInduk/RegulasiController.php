<?php

namespace App\Http\Controllers\frontend\dokumenlpm\DokumenInduk;

use App\Http\Controllers\Controller;
use App\Models\Regulasi;
use App\Models\ContentFooter;


class RegulasiController extends Controller
{
    public function index()
    {
        $data = Regulasi::orderBy('tahun', 'desc')->get();
        $content_footer = ContentFooter::first();
        return view('frontend.dokumen_lpm.dokumen_induk.regulasi', compact('data','content_footer'));
    }
}
