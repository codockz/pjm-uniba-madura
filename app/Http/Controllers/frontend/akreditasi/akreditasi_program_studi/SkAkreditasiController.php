<?php

namespace App\Http\Controllers\frontend\akreditasi\akreditasi_program_studi;

use App\Http\Controllers\Controller;
use App\Models\SkAkreditasiProdi;
use App\Models\ContentFooter;


class SkAkreditasiController extends Controller
{
    public function index()
    {
        $data = SkAkreditasiProdi::latest()->get();
        $content_footer = ContentFooter::first();
        return view('frontend.akreditasi_unb.program_study.akreditasi_program_studi', compact('data','content_footer'));
    }
}
