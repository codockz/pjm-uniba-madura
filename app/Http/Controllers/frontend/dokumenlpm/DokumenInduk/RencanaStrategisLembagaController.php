<?php

namespace App\Http\Controllers\frontend\dokumenlpm\DokumenInduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RencanaStrategisLembaga;

class RencanaStrategisLembagaController extends Controller
{
    public function index()
    {

        $data = RencanaStrategisLembaga::latest()->first();

        return view('frontend.dokumen_lpm.dokumen_induk.rencanastrategislembaga', compact('data'));
    }
}
