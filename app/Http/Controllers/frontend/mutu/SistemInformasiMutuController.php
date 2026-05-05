<?php

namespace App\Http\Controllers\frontend\mutu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SistemInformasiMutu;
use App\Models\ContentFooter;

class SistemInformasiMutuController extends Controller
{
    public function index()
    {
        $data = SistemInformasiMutu::orderBy('nama_penyelenggara')->get();
        $content_footer = ContentFooter::first();

        return view('frontend.mutu.index', compact('data', 'content_footer'));
    }
}
