<?php

namespace App\Http\Controllers\frontend\profil;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasiGambar;
use App\Models\StrukturOrganisasiDeskripsi;
use App\Models\ContentFooter;

class StrukturOrganisasiController extends Controller
{
    public function struktur_organisasi()
    {
        $title = 'Struktur Organisasi';
        $content_footer = ContentFooter::first();

        $gambar = StrukturOrganisasiGambar::first();
        $data = StrukturOrganisasiDeskripsi::orderBy('urutan')->get();

        return view('frontend.profile.struktur_organisasi', compact(
            'title',
            'content_footer',
            'gambar',
            'data'
        ));
    }
}
