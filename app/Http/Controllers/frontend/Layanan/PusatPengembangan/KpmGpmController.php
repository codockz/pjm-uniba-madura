<?php

namespace App\Http\Controllers\frontend\Layanan\PusatPengembangan;

use App\Models\KpmGpm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KpmGpmController extends Controller
{
    public function index()
    {
        $data = KpmGpm::latest()->get();

        return view('frontend.layanan.pusat_pengembangan_mutu.kpm_gpm', compact('data'));
    }
}

