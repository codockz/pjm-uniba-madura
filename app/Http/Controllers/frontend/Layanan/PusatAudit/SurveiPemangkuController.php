<?php

namespace App\Http\Controllers\frontend\layanan\PusatAudit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SurveiPemangku;

class SurveiPemangkuController extends Controller
{
    public function index()
    {
        $data = SurveiPemangku::orderBy('pengisi')->get();

        return view('frontend.layanan.pusat_audit.survei_pemangku', compact('data'));
    }
}
