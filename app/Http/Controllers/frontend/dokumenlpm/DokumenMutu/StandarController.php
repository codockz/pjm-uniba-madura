<?php

namespace App\Http\Controllers\frontend\dokumenlpm\DokumenMutu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Standar;

class StandarController extends Controller
{
    public function index()
    {
        $data = Standar::latest()->get();

        return view('frontend.dokumen_lpm.dokumen_mutu.standar', compact('data'));
    }
}
