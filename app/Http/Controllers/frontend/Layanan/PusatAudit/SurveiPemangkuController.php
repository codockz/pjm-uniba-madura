<?php

namespace App\Http\Controllers\frontend\layanan\PusatAudit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SurveiPemangku;
use App\Models\ContentFooter;

class SurveiPemangkuController extends Controller
{
    public function index()
    {
        $data = SurveiPemangku::orderBy('pengisi')->get();
        $content_footer = ContentFooter::first();

        return view('frontend.layanan.pusat_audit.survei_pemangku', compact('data','content_footer'));
    }
}
