<?php

namespace App\Http\Controllers\frontend\dokumenlpm\DokumenInduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KebijakanRektor;
use App\Models\ContentFooter;


class KebijakanRektorController extends Controller
{
    public function index()
    {
        $data = KebijakanRektor::latest()->get();
        $content_footer = ContentFooter::first();
        return view('frontend.dokumen_lpm.dokumen_induk.kebijakanrektor', compact('data','content_footer'));
    }
}
