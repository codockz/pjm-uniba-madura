<?php

namespace App\Http\Controllers\frontend\dokumenlpm\DokumenMutu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sop;

class SopController extends Controller
{
    public function index()
    {
        $data = Sop::latest()->get(); 

        return view('frontend.dokumen_lpm.dokumen_mutu.sop', compact('data'));
    }
}
