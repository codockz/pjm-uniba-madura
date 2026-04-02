<?php

namespace App\Http\Controllers\frontend\profil;
use App\Models\ContentFooter;
use App\Http\Controllers\Controller;
use App\Models\VisiMisiTujuan;
use App\Models\JudulGambarIsi;
use Illuminate\Http\Request;

class VisiDanMisiController extends Controller
{
    public function VisiMisiTujuan()
    {
        $data = VisiMisiTujuan::whereIn('visi_misi_tujuan', ['visi', 'misi', 'tujuan'])->get();
        $setting = JudulGambarIsi::where('kategori', 'visi_misi')->first();

        $visi = $data->where('visi_misi_tujuan', 'visi');
        $misi = $data->where('visi_misi_tujuan', 'misi');
        $tujuan = $data->where('visi_misi_tujuan', 'tujuan');
        $content_footer = ContentFooter::first();

        return view('frontend.profile.visi_dan_misi', compact('data', 'visi', 'misi', 'tujuan', 'content_footer', 'setting'));
    }
}
