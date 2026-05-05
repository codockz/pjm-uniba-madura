<?php

namespace App\Http\Controllers\frontend\dokumenlpm\DokumenInduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DokumenSpmi;
use App\Models\ContentFooter;


class DokumenSPMIController extends Controller
{
    public function index()
    {
        $data = DokumenSpmi::latest()->get();
        $content_footer = ContentFooter::first();
        return view('frontend.dokumenlpm.dokumen_induk.dokumen_spmi.index', compact('data','content_footer'));
    }
}
