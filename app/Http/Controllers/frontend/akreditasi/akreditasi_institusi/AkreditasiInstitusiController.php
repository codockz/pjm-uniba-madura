<?php

namespace App\Http\Controllers\frontend\akreditasi\akreditasi_institusi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AkreditasiInstitusi;
use App\Models\ContentFooter;

class AkreditasiInstitusiController extends Controller
{
    public function index()
    {
        $data = AkreditasiInstitusi::latest()->get();
        $content_footer = ContentFooter::first();

        return view('frontend.akreditasi_unb.institusi.akreditasi_institusi', compact('data','content_footer'));
    }
}
