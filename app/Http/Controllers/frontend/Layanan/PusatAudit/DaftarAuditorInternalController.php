<?php

namespace App\Http\Controllers\frontend\Layanan\PusatAudit;

use App\Http\Controllers\Controller;
use App\Models\AuditorInternal;
use App\Models\ContentFooter;

class DaftarAuditorInternalController extends Controller
{
    public function index()
    {
        $data = AuditorInternal::orderBy('nama')->get();
        $content_footer = ContentFooter::first();

        return view('frontend.layanan.pusat_audit.daftar_auditor_internal', compact('data','content_footer'));
    }
}
