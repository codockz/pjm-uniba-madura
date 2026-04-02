<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\VisiMisiTujuan;
use App\Models\PetugasPersonalia;
use App\Models\Personalia;
use App\Models\TupoksiPjm;
use App\Models\StrukturOrganisasi;
use App\Models\Divisi;
use App\Models\Dokumen;
use App\Models\Media;
use App\Models\SettingHalamanUtama;
use App\Models\ContentFooter;
use App\Models\About;
use App\Models\Kerjasama;
use App\Models\JudulGambarIsi;
use App\Models\AnggotaDivisi;
use App\Models\SubKategoriDokumen;
use App\Models\KategoriDokumen;
// use App\Models\kategoriSubKategoriDokumen;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    public function frontend()
{
    $data = SettingHalamanUtama::all();
    $about = About::first();
    $kerjasama = Kerjasama::all();
    $content_footer = ContentFooter::first();
    $dokumen = Dokumen::count();
    $jumlh_media = Media::count();
    $kategori = KategoriDokumen::all();
    $sub_kategori = SubKategoriDokumen::all();

    $media = Media::leftJoin('kategori_media', 'kategori_media.id', 'media.kategori_media_id')
        ->where('nama_kategori', 'Pengumuman')
        ->select('media.*', 'kategori_media.nama_kategori')
        ->orderBy('created_at', 'asc')
        ->limit(4)
        ->get();

    $berita = Media::leftJoin('kategori_media', 'kategori_media.id', 'media.kategori_media_id')
        ->where('nama_kategori', 'Berita')
        ->select('media.*', 'kategori_media.nama_kategori')
        ->orderBy('created_at', 'asc')
        ->limit(4)
        ->get();

    // ✅ SAFE DATE
    try {
        $now = request()->has('month')
            ? Carbon::createFromFormat('Y-m', request('month'))
            : Carbon::now();
    } catch (\Exception $e) {
        $now = Carbon::now();
    }

    $year  = $now->year;
    $month = $now->month;

    $daysInMonth = $now->daysInMonth;
    $startDay = $now->copy()->startOfMonth()->dayOfWeek;

    $datesWithBerita = Media::whereYear('tanggal', $year)
        ->whereMonth('tanggal', $month)
        ->pluck('tanggal')
        ->map(function ($date) {
            return date('d', strtotime($date));
        })
        ->toArray();

    $arsip = Media::selectRaw('YEAR(tanggal) as year, MONTH(tanggal) as month')
        ->distinct()
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();

    $recentPosts = Media::latest()->take(5)->get();

    return view('frontend.pjm.index', compact(
        'data', 'dokumen', 'media', 'berita', 'content_footer', 'about',
        'kerjasama', 'jumlh_media', 'kategori', 'sub_kategori',
        'now', 'daysInMonth', 'startDay', 'recentPosts',
        'datesWithBerita', 'arsip', 'year', 'month'
    ));
}
    public function Dokumen(Request $request, $data)
    {
        $subcategory = $data;
        $title = $data;
        $content_footer = ContentFooter::first();
        $kategori = KategoriDokumen::all();
        $sub_kategori = SubKategoriDokumen::all();
        $data = Dokumen::leftJoin('sub_kategori_dokumens', 'sub_kategori_dokumens.id', 'dokumens.sub_kategori_dokumen_id')->where('sub_kategori_dokumen', $subcategory)->select('dokumens.*', 'sub_kategori_dokumens.sub_kategori_dokumen')->get();

        return view('frontend.dokumen.index', compact('data', 'content_footer', 'title', 'kategori', 'sub_kategori'));
    }

    public function profile()
    {
        $kategori = KategoriDokumen::all();
        $sub_kategori = SubKategoriDokumen::all();
        $data = Profile::all();
        $profil = JudulGambarIsi::where('kategori', 'profil')->first();
        $content_footer = ContentFooter::first();

        return view('frontend.profile.index', compact('data', 'content_footer', 'profil', 'sub_kategori', 'kategori'));
    }

    public function VisiMisiTujuan()
    {
        $data = VisiMisiTujuan::whereIn('visi_misi_tujuan', ['visi', 'misi', 'tujuan'])->get();
        $setting = JudulGambarIsi::where('kategori', 'visi_misi')->first();

        $visi = $data->where('visi_misi_tujuan', 'visi');
        $misi = $data->where('visi_misi_tujuan', 'misi');
        $tujuan = $data->where('visi_misi_tujuan', 'tujuan');
        $content_footer = ContentFooter::first();

        return view('frontend.visi_misi_tujuan.index', compact('data', 'visi', 'misi', 'tujuan', 'content_footer', 'setting'));
    }

    public function tupoksi_pjm()
    {
        $content_footer = ContentFooter::first();
        $data = TupoksiPjm::leftJoin('kategori_tupoksi_pjms', 'kategori_tupoksi_pjms.id', 'tupoksi_pjms.kategori_tupoksi_id')->select('tupoksi_pjms.*', 'kategori_tupoksi_pjms.nama_kategori')->get();
        return view('frontend.tupoksi-pjm.index', compact('data', 'content_footer'));
    }

    public function struktur_organisasi()
    {
        $content_footer = ContentFooter::first();
        $data = StrukturOrganisasi::leftJoin('kategori_struktur_organisasis', 'kategori_struktur_organisasis.id', 'struktur_organisasis.kategori_struktur_id')
            ->select('struktur_organisasis.*', 'kategori_struktur_organisasis.nama_kategori')
            ->groupBy('struktur_organisasis.id', 'kategori_struktur_organisasis.nama_kategori') // Include the necessary columns in GROUP BY
            ->get()
            ->toArray();

        $skippedCount = 0;
        $skippedJabatans = ['Ketua Struktur Organisasi', 'Sekretaris']; // Add jabatans you want to skip here

        foreach ($data as $key => $x) {
            // Check if the jabatan should be skipped
            if (in_array($x['jabatan'], $skippedJabatans)) {
                $skippedCount++;

                // Skip the record
                unset($data[$key]);
            }

            // Break the loop after skipping two records
            if ($skippedCount >= 2) {
                break;
            }
        }

        // Re-index the array after removing elements
        $data = array_values($data);

        $i = StrukturOrganisasi::leftJoin('kategori_struktur_organisasis', 'kategori_struktur_organisasis.id', 'struktur_organisasis.kategori_struktur_id')->select('struktur_organisasis.*', 'kategori_struktur_organisasis.nama_kategori');
        $j = StrukturOrganisasi::leftJoin('kategori_struktur_organisasis', 'kategori_struktur_organisasis.id', 'struktur_organisasis.kategori_struktur_id')->select('struktur_organisasis.*', 'kategori_struktur_organisasis.nama_kategori');

        return view('frontend.struktur-organisasi.index', compact('data', 'i', 'j', 'content_footer'));
    }

    public function divisi_akreditasi()
    {
        $content_footer = ContentFooter::first();
        $data = Divisi::leftJoin('kategori_divisis', 'kategori_divisis.id', 'divisis.kategori_divisi_id')->leftJoin('anggota_divisis', 'anggota_divisis.id', 'divisis.anggota_divisi_id')->where('nama_kategori', 'Divisi Akreditasi')->select('divisis.*', 'kategori_divisis.nama_kategori', 'anggota_divisis.foto', 'anggota_divisis.nama_anggota')->get();

        return view('frontend.divisi.divisi-akreditasi', compact('data', 'content_footer'));
    }

    public function Divisi(Request $request)
    {
        $title = $request->data;
        $content_footer = ContentFooter::first();
        $data = Divisi::leftJoin('sub_kategori_divisis', 'sub_kategori_divisis.id', 'divisis.sub_kategori_divisi_id')->leftJoin('anggota_divisis', 'anggota_divisis.id', 'divisis.anggota_divisi_id')->where('sub_kategori_divisi', $request->data)->select('divisis.*', 'sub_kategori_divisis.sub_kategori_divisi', 'anggota_divisis.foto', 'anggota_divisis.nama_anggota')->get();

        return view('frontend.divisi.index', compact('data', 'content_footer', 'title'));
    }

    public function divisi_eksplorasi_data()
    {
        $content_footer = ContentFooter::first();
        $data = Divisi::leftJoin('kategori_divisis', 'kategori_divisis.id', 'divisis.kategori_divisi_id')->leftJoin('anggota_divisis', 'anggota_divisis.id', 'divisis.anggota_divisi_id')->where('nama_kategori', 'Divisi Eksplorasi Data')->select('divisis.*', 'kategori_divisis.nama_kategori', 'anggota_divisis.foto', 'anggota_divisis.nama_anggota')->get();

        return view('frontend.divisi.divisi-eksplorasi-data', compact('data', 'content_footer'));
    }

    public function divisi_monitoring_dan_evaluasi()
    {
        $content_footer = ContentFooter::first();
        $data = Divisi::leftJoin('kategori_divisis', 'kategori_divisis.id', 'divisis.kategori_divisi_id')->leftJoin('anggota_divisis', 'anggota_divisis.id', 'divisis.anggota_divisi_id')->where('nama_kategori', 'Divisi Monitoring Dan Evaluasi')->select('divisis.*', 'kategori_divisis.nama_kategori', 'anggota_divisis.foto', 'anggota_divisis.nama_anggota')->get();

        return view('frontend.divisi.divisi-monitoring-dan-evaluasi', compact('data', 'content_footer'));
    }

    public function divisi_pengembangan_dokumen()
    {
        $content_footer = ContentFooter::first();
        $data = Divisi::leftJoin('kategori_divisis', 'kategori_divisis.id', 'divisis.kategori_divisi_id')->leftJoin('anggota_divisis', 'anggota_divisis.id', 'divisis.anggota_divisi_id')->where('nama_kategori', 'Divisi Pengembangan Dokumen')->select('divisis.*', 'kategori_divisis.nama_kategori', 'anggota_divisis.foto', 'anggota_divisis.nama_anggota')->get();

        return view('frontend.divisi.divisi-pengembangan-dokumen', compact('data', 'content_footer'));
    }

    public function divisi_akreditasi_internasional()
    {
        $content_footer = ContentFooter::first();
        $data = Divisi::leftJoin('kategori_divisis', 'kategori_divisis.id', 'divisis.kategori_divisi_id')->leftJoin('anggota_divisis', 'anggota_divisis.id', 'divisis.anggota_divisi_id')->where('nama_kategori', 'Divisi Akreditasi Internasional')->select('divisis.*', 'kategori_divisis.nama_kategori', 'anggota_divisis.foto', 'anggota_divisis.nama_anggota')->get();

        return view('frontend.divisi.divisi-akreditasi-internasional', compact('data', 'content_footer'));
    }

    public function dokumen_kebijakan()
    {
        $content_footer = ContentFooter::first();
        $data = Dokumen::leftJoin('sub_kategori_dokumens', 'sub_kategori_dokumens.id', 'dokumens.sub_kategori_dokumen_id')->where('sub_kategori_dokumen', 'Kebijakan Mutu')->select('dokumens.*', 'sub_kategori_dokumens.sub_kategori_dokumen')->get();

        return view('frontend.dokumen_mutu.dokumen_kebijakan', compact('data', 'content_footer'));
    }

    public function dokumen_manual()
    {
        $content_footer = ContentFooter::first();
        $data = Dokumen::leftJoin('kategori_dokumens', 'kategori_dokumens.id', 'dokumens.kategori_dokumen_id')->where('nama_kategori', 'Manual Mutu')->select('dokumens.*', 'kategori_dokumens.nama_kategori')->get();

        return view('frontend.dokumen_mutu.dokumen_manual', compact('data', 'content_footer'));
    }

    public function dokumen_standar()
    {
        $content_footer = ContentFooter::first();
        $data = Dokumen::leftJoin('kategori_dokumens', 'kategori_dokumens.id', 'dokumens.kategori_dokumen_id')->where('nama_kategori', 'Standar Mutu')->select('dokumens.*', 'kategori_dokumens.nama_kategori')->get();

        return view('frontend.dokumen_mutu.dokumen_standar', compact('data', 'content_footer'));
    }

    public function dokumen_formulir()
    {
        $content_footer = ContentFooter::first();
        $data = Dokumen::leftJoin('kategori_dokumens', 'kategori_dokumens.id', 'dokumens.kategori_dokumen_id')->where('nama_kategori', 'Formulir Mutu')->select('dokumens.*', 'kategori_dokumens.nama_kategori')->get();

        return view('frontend.dokumen_mutu.dokumen_formulir', compact('data', 'content_footer'));
    }

    public function dokumen_sop()
    {
        $content_footer = ContentFooter::first();
        $data = Dokumen::leftJoin('kategori_dokumens', 'kategori_dokumens.id', 'dokumens.kategori_dokumen_id')->where('nama_kategori', 'SOP/POS')->select('dokumens.*', 'kategori_dokumens.nama_kategori')->get();

        return view('frontend.dokumen_mutu.dokumen_formulir', compact('data', 'content_footer'));
    }

    public function statistik()
    {
        $content_footer = ContentFooter::first();
        $data = Dokumen::leftJoin('kategori_dokumens', 'kategori_dokumens.id', 'dokumens.kategori_dokumen_id')->where('nama_kategori', 'Statistik Perolehan Akreditasi Program Studi')->select('dokumens.*', 'kategori_dokumens.nama_kategori')->get();

        return view('frontend.akreditasi.statistik', compact('data', 'content_footer'));
    }

    public function Pengajuan()
    {
        $content_footer = ContentFooter::first();
        $data = Dokumen::leftJoin('kategori_dokumens', 'kategori_dokumens.id', 'dokumens.kategori_dokumen_id')->where('nama_kategori', 'Data Pengajuan Akreditasi Prodi')->select('dokumens.*', 'kategori_dokumens.nama_kategori')->get();

        return view('rontend.akreditasi.pengajuan', compact('data', 'content_footer'));
    }

    public function SertifikasiProdi()
    {
        $content_footer = ContentFooter::first();
        $data = Dokumen::leftJoin('kategori_dokumens', 'kategori_dokumens.id', 'dokumens.kategori_dokumen_id')->where('nama_kategori', 'Instrumen Akreditasi Kriteria')->select('dokumens.*', 'kategori_dokumens.nama_kategori')->get();

        return view('frontend.akreditasi.sertifikasi_prodi', compact('data', 'content_footer'));
    }

    public function AkreditasiKriteria()
    {
        $content_footer = ContentFooter::first();
        $data = Dokumen::leftJoin('kategori_dokumens', 'kategori_dokumens.id', 'dokumens.kategori_dokumen_id')->where('nama_kategori', 'Instrumen Akreditasi 9 Kriteria')->select('dokumens.*', 'kategori_dokumens.nama_kategori')->get();

        return view('frontend.akreditasi.instrumen_akreditasi', compact('data', 'content_footer'));
    }
    public function PemantauanAkreditasi()
    {
        $content_footer = ContentFooter::first();
        $data = Dokumen::leftJoin('kategori_dokumens', 'kategori_dokumens.id', 'dokumens.kategori_dokumen_id')->where('nama_kategori', 'Instrumen Pemantauan Akreditasi')->select('dokumens.*', 'kategori_dokumens.nama_kategori')->get();

        return view('frontend.akreditasi.instrumen_pemantauan_akreditasi', compact('data', 'content_footer'));
    }

    public function SistemSatu()
    {
        $content_footer = ContentFooter::first();
        $data = Dokumen::leftJoin('kategori_dokumens', 'kategori_dokumens.id', 'dokumens.kategori_dokumen_id')->where('nama_kategori', 'Sistem SATU')->select('dokumens.*', 'kategori_dokumens.nama_kategori')->get();

        return view('frontend.sistem_penjaminan_mutu.dokumen_satu', compact('data', 'content_footer'));
    }

    public function SistemAmi()
    {
        $content_footer = ContentFooter::first();
        $data = Dokumen::leftJoin('kategori_dokumens', 'kategori_dokumens.id', 'dokumens.kategori_dokumen_id')->where('nama_kategori', 'Sistem AMI')->select('dokumens.*', 'kategori_dokumens.nama_kategori')->get();

        return view('frontend.sistem_penjaminan_mutu.dokumen_ami', compact('data', 'content_footer'));
    }

    public function InstrumenAmi()
    {
        $content_footer = ContentFooter::first();
        $data = Dokumen::leftJoin('kategori_dokumens', 'kategori_dokumens.id', 'dokumens.kategori_dokumen_id')->where('nama_kategori', 'Laporan & Instrumen AMI')->select('dokumens.*', 'kategori_dokumens.nama_kategori')->get();

        return view('frontend.sistem_penjaminan_mutu.laporan_instrumen_ami', compact('data', 'content_footer'));
    }

    public function Pedoman()
    {
        $content_footer = ContentFooter::first();
        $data = Dokumen::leftJoin('kategori_dokumens', 'kategori_dokumens.id', 'dokumens.kategori_dokumen_id')->where('nama_kategori', 'Pedoman/Panduan')->select('dokumens.*', 'kategori_dokumens.nama_kategori')->get();

        return view('frontend.sistem_penjaminan_mutu.pedoman', compact('data', 'content_footer'));
    }

    public function DokumenSpmi()
    {
        $content_footer = ContentFooter::first();
        $data = Dokumen::leftJoin('kategori_dokumens', 'kategori_dokumens.id', 'dokumens.kategori_dokumen_id')->where('nama_kategori', 'Dokumen SPMI')->select('dokumens.*', 'kategori_dokumens.nama_kategori')->get();

        return view('frontend.dokumen_lainnya.dokumen_spmi', compact('data', 'content_footer'));
    }

    public function LaporanKegiatan()
    {
        $content_footer = ContentFooter::first();
        $data = Dokumen::leftJoin('kategori_dokumens', 'kategori_dokumens.id', 'dokumens.kategori_dokumen_id')->where('nama_kategori', 'Laporan Kegiatan')->select('dokumens.*', 'kategori_dokumens.nama_kategori')->get();

        return view('frontend.dokumen_lainnya.laporan_kegiatan', compact('data', 'content_footer'));
    }

    public function LaporanMonev()
    {
        $content_footer = ContentFooter::first();
        $data = Dokumen::leftJoin('kategori_dokumens', 'kategori_dokumens.id', 'dokumens.kategori_dokumen_id')->where('nama_kategori', 'Laporan Monev')->select('dokumens.*', 'kategori_dokumens.nama_kategori')->get();

        return view('frontend.dokumen_lainnya.laporan_monev', compact('data', 'content_footer'));
    }

    public function LaporanAmi()
    {
        $content_footer = ContentFooter::first();
        $data = Dokumen::leftJoin('kategori_dokumens', 'kategori_dokumens.id', 'dokumens.kategori_dokumen_id')->where('nama_kategori', 'Laporan AMI')->select('dokumens.*', 'kategori_dokumens.nama_kategori')->get();

        return view('frontend.dokumen_lainnya.laporan_ami', compact('data', 'content_footer'));
    }

    // berita
    public function mediaBertia($slug)
    {
        $content_footer = ContentFooter::first();
        $pengumuman = Media::leftJoin('kategori_media', 'kategori_media.id', 'media.kategori_media_id')->where('nama_kategori', 'Pengumuman')->select('media.*', 'kategori_media.nama_kategori')->get();
        $berita = Media::leftJoin('kategori_media', 'kategori_media.id', 'media.kategori_media_id')->leftJoin('users', 'users.id', 'media.user_id')->where('slug', $slug)->select('media.*', 'kategori_media.nama_kategori', 'users.name')->first();

        $semua_berita = Media::leftJoin('kategori_media', 'kategori_media.id', 'media.kategori_media_id')
            ->where('nama_kategori', 'Berita')
            ->where('slug', '!=', $berita->slug) // Exclude the news with the same slug
            ->select('media.*', 'kategori_media.nama_kategori')
            ->orderBy('created_at', 'ASC')
            ->take(5)
            ->get();
        // dd($semua_berita);
        return view('frontend.pjm.berita', compact('berita', 'pengumuman', 'semua_berita', 'content_footer'));
    }

    public function mediaPengumuman($slug)
    {
        $content_footer = ContentFooter::first();
        $berita = Media::leftJoin('kategori_media', 'kategori_media.id', 'media.kategori_media_id')->where('nama_kategori', 'Berita')->select('media.*', 'kategori_media.nama_kategori')->get();

        $pengumuman = Media::leftJoin('kategori_media', 'kategori_media.id', 'media.kategori_media_id')->leftJoin('users', 'users.id', 'media.user_id')->where('slug', $slug)->select('media.*', 'kategori_media.nama_kategori', 'users.name')->first();

        $semua_pengumuman = Media::leftJoin('kategori_media', 'kategori_media.id', 'media.kategori_media_id')
            ->where('nama_kategori', 'Pengumuman')
            ->where('slug', '!=', $pengumuman->slug) // Exclude the news with the same slug
            ->select('media.*', 'kategori_media.nama_kategori')
            ->orderBy('created_at', 'ASC')
            ->take(5)
            ->get();
        // dd($semua_berita);
        return view('frontend.pjm.pengumuman', compact('berita', 'pengumuman', 'semua_pengumuman', 'content_footer'));
    }

    // public function mediaAgenda($slug)
    // {
    //     $content_footer = ContentFooter::first();
    //     $berita = Media::leftJoin('kategori_media', 'kategori_media.id', 'media.kategori_media_id')->where('nama_kategori', 'Berita')->select('media.*', 'kategori_media.nama_kategori')->get();
    //     $pengumuman = Media::leftJoin('kategori_media', 'kategori_media.id', 'media.kategori_media_id')->where('nama_kategori', 'Pengumuman')->select('media.*', 'kategori_media.nama_kategori')->get();
    //     $agenda = Media::leftJoin('kategori_media', 'kategori_media.id', 'media.kategori_media_id')->leftJoin('users', 'users.id', 'media.user_id')->where('slug', $slug)->select('media.*', 'kategori_media.nama_kategori', 'users.name')->first();
    //     // dd($agenda->tanggal);
    //     $semua_agenda = Media::leftJoin('kategori_media', 'kategori_media.id', 'media.kategori_media_id')
    //         ->where('nama_kategori', 'Agenda')
    //         ->where('slug', '!=', $agenda->slug) // Exclude the news with the same slug
    //         ->select('media.*', 'kategori_media.nama_kategori')
    //         ->orderBy('created_at', 'ASC')
    //         ->take(5)
    //         ->get();
    //     // dd($semua_berita);
    //     return view('frontend.pjm.agenda', compact('pengumuman', 'agenda', 'semua_agenda', 'content_footer', 'berita'));
    // }
    public function pengumuman()
    {
        $content_footer = ContentFooter::first();
        $pengumuman = Media::leftJoin('kategori_media', 'kategori_media.id', 'media.kategori_media_id')->where('nama_kategori', 'Pengumuman')->select('media.*', 'kategori_media.nama_kategori')->get();

        return view('frontend.pengumuman.index', compact('pengumuman', 'content_footer'));
    }

    public function berita()
    {
        $content_footer = ContentFooter::first();
        $berita = Media::leftJoin('kategori_media', 'kategori_media.id', 'media.kategori_media_id')->where('nama_kategori', 'Berita')->select('media.*', 'kategori_media.nama_kategori')->get();

        return view('frontend.berita.index', compact('berita', 'content_footer'));
    }

    public function foto()
    {
        $content_footer = ContentFooter::first();
        $foto = Media::leftJoin('kategori_media', 'kategori_media.id', 'media.kategori_media_id')->where('nama_kategori', 'Foto')->select('media.*', 'kategori_media.nama_kategori')->get();

        return view('frontend.foto.index', compact('foto', 'content_footer'));
    }
    public function byMonth($year, $month)
{
    // ✅ VALIDASI PARAMETER
    if (!is_numeric($year) || !is_numeric($month)) {
        $year  = now()->year;
        $month = now()->month;
    }

    try {
        $date = Carbon::create((int)$year, (int)$month, 1);
    } catch (\Exception $e) {
        $date = now();
    }

    $dokumen = Media::leftJoin('kategori_media', 'kategori_media.id', 'media.kategori_media_id')
        ->where('kategori_media.nama_kategori', 'Dokumen')
        ->select('media.*', 'kategori_media.nama_kategori')
        ->latest()
        ->get();

    $berita = Media::whereYear('tanggal', $date->year)
        ->whereMonth('tanggal', $date->month)
        ->latest()
        ->get();

    $kerjasama = Media::leftJoin('kategori_media', 'kategori_media.id', 'media.kategori_media_id')
        ->where('kategori_media.nama_kategori', 'Kerjasama')
        ->select('media.*', 'kategori_media.nama_kategori')
        ->latest()
        ->get();

    $jumlh_media = Media::count();

    $now = $date;
    $daysInMonth = $now->daysInMonth;
    $startDay = $now->copy()->startOfMonth()->dayOfWeek;

    $arsip = Media::selectRaw('YEAR(tanggal) as year, MONTH(tanggal) as month')
        ->distinct()
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();

    $datesWithBerita = Media::whereYear('tanggal', $now->year)
        ->whereMonth('tanggal', $now->month)
        ->pluck('tanggal')
        ->map(function ($date) {
            return date('d', strtotime($date));
        })
        ->toArray();

    $recentPosts = Media::latest()->take(5)->get();

    return view('frontend.pjm.index', [
        'berita' => $berita,
        'dokumen' => $dokumen,
        'year' => $now->year,
        'month' => $now->month,
        'jumlh_media' => $jumlh_media,
        'kerjasama' => $kerjasama,
        'recentPosts' => $recentPosts,
        'now' => $now,
        'daysInMonth' => $daysInMonth,
        'startDay' => $startDay,
        'datesWithBerita' => $datesWithBerita,
        'arsip' => $arsip
    ]);
}
}
