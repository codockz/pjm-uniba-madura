<?php

namespace App\Http\Controllers\frontend\Layanan\PusatPengembangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiklusSpmi;
use App\Models\SpmiDiagram;
use App\Models\ContentFooter;

class SiklusSPMIController extends Controller
{
    public function index()
    {
        $diagram = SpmiDiagram::first();
        $tahapan = SiklusSpmi::orderBy('urutan')->get();
        $content_footer = ContentFooter::first();

        return view('frontend.layanan.pusat_pengembangan_mutu.siklus_spmi', compact('diagram', 'tahapan','content_footer'));
    }
}
