<?php

namespace App\Http\Controllers\frontend\Layanan\PusatAudit;

use App\Http\Controllers\Controller;
use App\Models\JadwalAmi;
use App\Models\ContentFooter;

class JadwalAmiController extends Controller
{
    public function index()
    {
        $content_footer = ContentFooter::first();

        $data = JadwalAmi::latest()->get();

        return view('frontend.layanan.pusat_audit.jadwal_ami', compact('data', 'content_footer'));
    }
}
