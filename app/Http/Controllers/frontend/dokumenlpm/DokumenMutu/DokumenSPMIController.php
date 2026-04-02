<?php

namespace App\Http\Controllers\frontend\dokumenlpm\DokumenMutu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DokumenSpmi;

class DokumenSPMIController extends Controller
{
    public function index()
    {
        $data = DokumenSpmi::latest()->get();

        return view('frontend.dokumen_lpm.dokumen_mutu.dokumenspmi', compact('data'));
    }
}

