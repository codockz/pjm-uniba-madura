<?php

namespace App\Http\Controllers\frontend\akreditasi\akreditasi_program_studi;

use App\Http\Controllers\Controller;
use App\Models\SkAkreditasiProdi;

class SkAkreditasiController extends Controller
{
    public function index()
    {
        $data = SkAkreditasiProdi::latest()->get();

        return view('frontend.akreditasi_unb.program_study.akreditasi_program_studi', compact('data'));
    }
}
