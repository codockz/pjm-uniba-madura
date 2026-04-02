<?php

namespace App\Http\Controllers\frontend\dokumenlpm\DokumenMutu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedoman;

class PedomanController extends Controller
{
     public function index()
    {
        $data = Pedoman::latest()->get();
        return view('frontend.dokumen_lpm.dokumen_mutu.pedoman', compact('data'));
    }
}
