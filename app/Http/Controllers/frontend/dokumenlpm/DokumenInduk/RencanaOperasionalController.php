<?php

namespace App\Http\Controllers\frontend\dokumenlpm\DokumenInduk;

use App\Http\Controllers\Controller;
use App\Models\RencanaOperasional;

class RencanaOperasionalController extends Controller
{
    public function index()
    {
        $data = RencanaOperasional::latest()->get();

        return view('frontend.dokumen_lpm.dokumen_induk.rencanaoperasional', compact('data'));
    }
}
