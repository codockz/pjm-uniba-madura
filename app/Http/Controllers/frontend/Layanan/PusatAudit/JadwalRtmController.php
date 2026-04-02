<?php

namespace App\Http\Controllers\frontend\Layanan\PusatAudit;
use App\Models\ContentFooter;
use App\Models\JadwalRtm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JadwalRtmController extends Controller
{
    public function index()
    {
        $content_footer = ContentFooter::first();

        $data = JadwalRtm::latest()->get();

        return view('frontend.layanan.pusat_audit.jadwal_rtm', compact('data', 'content_footer'));
    }
}
