<?php

namespace App\Http\Controllers\frontend\dokumenlpm\DokumenInduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StatuaOrtaker;
use App\Models\StatuaOrtakerImage;
use App\Models\ContentFooter;

class StatuaOrtakerController extends Controller
{
    public function index()
    {
        $data = StatuaOrtaker::orderBy('urutan')->get();
        $image = StatuaOrtakerImage::first();
        $content_footer = ContentFooter::first();

        return view('frontend.dokumen_lpm.dokumen_induk.statuaortaker', compact('data', 'image','content_footer'));
    }
}
