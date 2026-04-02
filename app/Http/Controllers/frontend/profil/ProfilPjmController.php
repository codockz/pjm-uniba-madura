<?php
namespace App\Http\Controllers\frontend\profil;

use App\Models\Profile;
use App\Http\Controllers\Controller;
use App\Models\KategoriDokumen;
use App\Models\SubKategoriDokumen;
use App\Models\JudulGambarIsi;
use App\Models\ContentFooter;
use Illuminate\Http\Request;

class ProfilPjmController extends Controller
{
    public function profilePjm()
    {
        $kategori = KategoriDokumen::all();
        $sub_kategori = SubKategoriDokumen::all();
        $data = Profile::all();
        $profil = JudulGambarIsi::where('kategori', 'profil')->first();
        $content_footer = ContentFooter::first();

        return view('frontend.profile.profile_pjm', compact('data', 'content_footer', 'profil', 'sub_kategori', 'kategori'));
    }

}
