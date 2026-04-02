<?php

namespace App\Http\Controllers\frontend\akreditasi\akreditasi_institusi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AkreditasiInstitusi;

class AkreditasiInstitusiController extends Controller
{
    public function index()
    {
        $data = AkreditasiInstitusi::latest()->get();

        return view('frontend.akreditasi_unb.institusi.akreditasi_institusi', compact('data'));
    }
}
