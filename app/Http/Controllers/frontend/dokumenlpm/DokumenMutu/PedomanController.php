<?php

namespace App\Http\Controllers\frontend\dokumenlpm\DokumenMutu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedoman;
use App\Models\ContentFooter;

class PedomanController extends Controller
{
     public function index()
    {
        $data = Pedoman::latest()->get();
        $content_footer = ContentFooter::first();
        return view('frontend.dokumen_lpm.dokumen_mutu.pedoman', compact('data','content_footer'));
    }
}
