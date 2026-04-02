<?php

namespace App\Http\Controllers\frontend\Layanan\PusatAudit;

use App\Http\Controllers\Controller;
use App\Models\AuditorInternal;

class DaftarAuditorInternalController extends Controller
{
    public function index()
    {
        $data = AuditorInternal::orderBy('nama')->get();

        return view('frontend.layanan.pusat_audit.daftar_auditor_internal', compact('data'));
    }
}
