<?php

namespace App\Http\Controllers\frontend\dokumenlpm\DokumenMutu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Standar;
use App\Models\ContentFooter;


class StandarController extends Controller
{
    public function index()
    {
        $data = Standar::latest()->get();
        $content_footer = ContentFooter::first();
        return view('frontend.dokumen_lpm.dokumen_mutu.standar', compact('data','content_footer'));
    }
}
