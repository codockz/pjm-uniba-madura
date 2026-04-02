<?php

namespace App\Http\Controllers\frontend\profil;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use App\Models\ContentFooter;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function struktur_organisasi()
    {
        $title = 'Struktur Organisasi';
        $content_footer = ContentFooter::first();

        return view('frontend.profile.struktur_organisasi');
    }
}
