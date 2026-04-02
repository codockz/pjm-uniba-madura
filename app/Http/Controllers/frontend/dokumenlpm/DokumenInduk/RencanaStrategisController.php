<?php

namespace App\Http\Controllers\frontend\dokumenlpm\DokumenInduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RencanaStrategis;

class RencanaStrategisController extends Controller
{
    public function index()
    {
        $data = RencanaStrategis::latest()->get();

        return view('frontend.dokumen_lpm.dokumen_induk.RencanaStrategis', compact('data'));
    }
}
