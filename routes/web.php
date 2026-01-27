<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\
{
    SettingWebProfileController,
    ProfileController,
    PetugasPersonaliaController,
    PersonaliaController,
    KategoriTupoksiPjmController,
    TupoksiPjmController,
    KategoriStrukturOrganisasiController,
    StrukturOrganisasiController,
    VisiMisiTujuanController,
    AnggotaDivisiController,
    KategoriDivisiController,
    DivisiController,
    KategoriDokumenController,
    DokumenController,
    KategoriPersonaliaController,
    SettingHalamanUtamaController,
    KategoriMediaController,
    MediaController,
    KerjasamaController,
    JudulGambarIsiController,
    SubKategoriDokumenController,
    UserController,
    SubKategoriDivisiController

};


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\FrontendController::class, 'frontend'])->name('frontend.frontend');


// frontend profil
Route::get('/profil', [App\Http\Controllers\FrontendController::class, 'profile'])->name('frontend.profile');
Route::get('/visi-misi', [App\Http\Controllers\FrontendController::class, 'VisiMisiTujuan'])->name('frontend.visi-misi');
Route::get('/pjm-personalia', [App\Http\Controllers\FrontendController::class, 'personalia'])->name('frontend.personalia');
Route::get('/tupoksi', [App\Http\Controllers\FrontendController::class, 'tupoksi_pjm'])->name('frontend.tupoksi_pjm');
Route::get('/struktur-organisasi', [App\Http\Controllers\FrontendController::class, 'struktur_organisasi'])->name('frontend.struktur_organisasi');
// frontend divisi
Route::get('/divisi-akreditasi', [App\Http\Controllers\FrontendController::class, 'divisi_akreditasi'])->name('frontend.divisi_akreditasi');
Route::get('/divisi-eksplorasi-data', [App\Http\Controllers\FrontendController::class, 'divisi_eksplorasi_data'])->name('frontend.divisi_eksplorasi_data');
Route::get('/divisi-monitoring-dan-evaluasi', [App\Http\Controllers\FrontendController::class, 'divisi_monitoring_dan_evaluasi'])->name('frontend.divisi_monitoring_dan_evaluasi');
Route::get('/divisi-pengembangan-dokumen', [App\Http\Controllers\FrontendController::class, 'divisi_pengembangan_dokumen'])->name('frontend.divisi_pengembangan_dokumen');
Route::get('/divisi-akreditasi-internasional', [App\Http\Controllers\FrontendController::class, 'divisi_akreditasi_internasional'])->name('frontend.divisi_akreditasi_internasional');
// frontend dokumen Mutu\

Route::get('/dokumen/{data}', [App\Http\Controllers\FrontendController::class, 'Dokumen'])->name('frontend.dokumen');
Route::get('/divisi/{data}', [App\Http\Controllers\FrontendController::class, 'Divisi'])->name('frontend.divisi');


Route::get('/dokumen-kebijakan', [App\Http\Controllers\FrontendController::class, 'dokumen_kebijakan'])->name('frontend.dokumen_kebijakan');
Route::get('/dokumen-manual-mutu', [App\Http\Controllers\FrontendController::class, 'dokumen_manual'])->name('frontend.dokumen_manual');
Route::get('/dokumen-standar-mutu', [App\Http\Controllers\FrontendController::class, 'dokumen_standar'])->name('frontend.dokumen_standar');
Route::get('/dokumen-formulir-mutu', [App\Http\Controllers\FrontendController::class, 'dokumen_formulir'])->name('frontend.dokumen_formulir');
Route::get('/dokumen-sop', [App\Http\Controllers\FrontendController::class, 'dokumen_sop'])->name('frontend.dokumen_sop');
// frontend statistik
Route::get('/statistik-perolehan-akreditasi-program-studi', [App\Http\Controllers\FrontendController::class, 'statistik'])->name('frontend.statistik');
Route::get('/data-pengajuan-akreditasi-prodi', [App\Http\Controllers\FrontendController::class, 'Pengajuan'])->name('frontend.pengajuan');
Route::get('/sk-dan-sertifikasi-prodi', [App\Http\Controllers\FrontendController::class, 'SertifikasiProdi'])->name('frontend.sertifikasi_prodi');
Route::get('/instrumen-akreditasi-kriteria', [App\Http\Controllers\FrontendController::class, 'AkreditasiKriteria'])->name('frontend.akreditasi_kriteria');
Route::get('/instrumen-pemantauan-akreditasi', [App\Http\Controllers\FrontendController::class, 'PemantauanAkreditasi'])->name('frontend.pemantauan_akreditasi');
// frontend sistem penjaminan mutu
Route::get('/sistem-satu', [App\Http\Controllers\FrontendController::class, 'SistemSatu'])->name('frontend.satu');
Route::get('/sistem-ami', [App\Http\Controllers\FrontendController::class, 'SistemAmi'])->name('frontend.sistem_ami');
Route::get('/laporan-instrumen-ami', [App\Http\Controllers\FrontendController::class, 'InstrumenAmi'])->name('frontend.instrumen_ami');
Route::get('/pedoman', [App\Http\Controllers\FrontendController::class, 'pedoman'])->name('frontend.pedoman');

// frontend sistem penjaminan mutu
Route::get('/dokumen-spmi', [App\Http\Controllers\FrontendController::class, 'DokumenSpmi'])->name('frontend.dokumen_spmi');
Route::get('/laporan-kegiatan', [App\Http\Controllers\FrontendController::class, 'LaporanKegiatan'])->name('frontend.laporan_kegiatan');
Route::get('/laporan-monev', [App\Http\Controllers\FrontendController::class, 'InstrumenAmi'])->name('frontend.laporan_monev');
Route::get('/laporan-ami', [App\Http\Controllers\FrontendController::class, 'LaporanAmi'])->name('frontend.laporan_ami');

// media
Route::get('/media-berita/{slug}', [App\Http\Controllers\FrontendController::class, 'mediaBertia'])->name('frontend.showBerita');
Route::get('/media-pengumuman/{slug}', [App\Http\Controllers\FrontendController::class, 'mediaPengumuman'])->name('frontend.showPengumuman');
Route::get('/media-agenda/{slug}', [App\Http\Controllers\FrontendController::class, 'mediaAgenda'])->name('frontend.showAgenda');

Route::get('/pengumuman', [App\Http\Controllers\FrontendController::class, 'pengumuman'])->name('frontend.pengumuman');
Route::get('/berita', [App\Http\Controllers\FrontendController::class, 'berita'])->name('frontend.berita');
Route::get('/foto', [App\Http\Controllers\FrontendController::class, 'foto'])->name('frontend.foto');
Route::get('/agenda', [App\Http\Controllers\FrontendController::class, 'agenda'])->name('frontend.agenda');

Auth::routes();
// -- admin -- //
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('setting_web',SettingWebProfileController::class);
Route::get('/get-footer-data', [App\Http\Controllers\ProfileController::class, 'getFooterData'])->name('getFooterData');

// profile
Route::resource('profile',ProfileController::class);
Route::get('/get-data', [App\Http\Controllers\ProfileController::class, 'getData'])->name('getData');
Route::post('/profile-updated', [App\Http\Controllers\ProfileController::class, 'updated'])->name('profile-updated');
Route::post('/profile-delete', [App\Http\Controllers\ProfileController::class, 'delete'])->name('profile-delete');

//kategori personalia
Route::resource('kategori_personalia',KategoriPersonaliaController::class);
Route::get('/kategori_personalia-get_data', [App\Http\Controllers\KategoriPersonaliaController::class, 'getData'])->name('kategori_personalia.getData');
Route::post('/kategori_personalia-updated', [App\Http\Controllers\KategoriPersonaliaController::class, 'updated'])->name('kategori_personalia.updated');
Route::post('/kategori_personalia-delete', [App\Http\Controllers\KategoriPersonaliaController::class, 'delete'])->name('kategori_personalia.delete');


//personalia
Route::resource('personalia',PersonaliaController::class);
Route::post('/personalia-updated', [App\Http\Controllers\PersonaliaController::class, 'updated'])->name('personalia-updated');
Route::post('/personalia-delete', [App\Http\Controllers\PersonaliaController::class, 'delete'])->name('personalia-delete');

//petugas-personalia
Route::resource('petugas_personalia',PetugasPersonaliaController::class);
Route::post('/petugas_personalia-updated', [App\Http\Controllers\PetugasPersonaliaController::class, 'updated'])->name('petugas_personalia-updated');
Route::post('/petugas_personalia-delete', [App\Http\Controllers\PetugasPersonaliaController::class, 'delete'])->name('petugas_personalia-delete');
Route::get('petugas_personalia/{petugas_personalia}/edit',  [App\Http\Controllers\PetugasPersonaliaController::class,'edit'])->name('petugas_personalia.edit');
// kategori tupoksi-pjpm
Route::resource('kategori_tupoksi_pjm',KategoriTupoksiPjmController::class);
Route::get('/kategori_tupoksi_pjm-get_data', [App\Http\Controllers\KategoriTupoksiPjmController::class, 'getData'])->name('kategori_tupoksi_pjm.getData');
Route::post('/kategori_tupoksi_pjm-updated', [App\Http\Controllers\KategoriTupoksiPjmController::class, 'updated'])->name('kategori_tupoksi_pjm.updated');
Route::post('/kategori_tupoksi_pjm-delete', [App\Http\Controllers\KategoriTupoksiPjmController::class, 'delete'])->name('kategori_tupoksi_pjm.delete');

// tupoksi-pjpm
Route::resource('tupoksi_pjm',TupoksiPjmController::class);
Route::get('/tupoksi_pjm-get_data', [App\Http\Controllers\TupoksiPjmController::class, 'getData'])->name('tupoksi_pjm.getData');
Route::post('/tupoksi_pjm-updated', [App\Http\Controllers\TupoksiPjmController::class, 'updated'])->name('tupoksi_pjm.updated');
Route::post('/tupoksi_pjm-delete', [App\Http\Controllers\TupoksiPjmController::class, 'delete'])->name('tupoksi_pjm.delete');

// kategori struktur organisasi
Route::resource('kategori_struktur_organisasi',KategoriStrukturOrganisasiController::class);
Route::get('/kategori_struktur_organisasi-get_data', [App\Http\Controllers\KategoriStrukturOrganisasiController::class, 'getData'])->name('kategori_struktur_organisasi.getData');
Route::post('/kategori_struktur_organisasi-updated', [App\Http\Controllers\KategoriStrukturOrganisasiController::class, 'updated'])->name('kategori_struktur_organisasi.updated');
Route::post('/kategori_struktur_organisasi-delete', [App\Http\Controllers\KategoriStrukturOrganisasiController::class, 'delete'])->name('kategori_struktur_organisasi.delete');

//struktur organisasi
Route::resource('struktur_organisasi',StrukturOrganisasiController::class);
Route::get('/struktur_organisasi-get_data', [App\Http\Controllers\StrukturOrganisasiController::class, 'getData'])->name('struktur_organisasi.getData');
Route::post('/struktur_organisasi-updated', [App\Http\Controllers\StrukturOrganisasiController::class, 'updated'])->name('struktur_organisasi.updated');
Route::post('/struktur_organisasi-delete', [App\Http\Controllers\StrukturOrganisasiController::class, 'delete'])->name('struktur_organisasi.delete');

// visi misi tujuan
Route::resource('visi_misi_tujuan',VisiMisiTujuanController::class);
Route::get('/visi_misi_tujuan-get_data', [App\Http\Controllers\VisiMisiTujuanController::class, 'getData'])->name('visi_misi_tujuan.getData');
Route::post('/visi_misi_tujuan-updated', [App\Http\Controllers\VisiMisiTujuanController::class, 'updated'])->name('visi_misi_tujuan.updated');
Route::post('/visi_misi_tujuan-delete', [App\Http\Controllers\VisiMisiTujuanController::class, 'delete'])->name('visi_misi_tujuan.delete');

// kategori divisi
Route::resource('kategori_divisi',KategoriDivisiController::class);
Route::get('/kategori_divisi-get_data', [App\Http\Controllers\KategoriDivisiController::class, 'getData'])->name('kategori_divisi.getData');
Route::post('/kategori_divisi-updated', [App\Http\Controllers\KategoriDivisiController::class, 'updated'])->name('kategori_divisi.updated');
Route::post('/kategori_divisi-delete', [App\Http\Controllers\KategoriDivisiController::class, 'delete'])->name('kategori_divisi.delete');
// sub kategori divisi
Route::resource('sub_kategori_divisi',SubKategoriDivisiController::class);
Route::get('/sub_kategori_divisi-getdata', [App\Http\Controllers\SubKategoriDivisiController::class, 'getData'])->name('sub_kategori_divisi.getData');
Route::post('/sub_kategori_divisi-updated', [App\Http\Controllers\SubKategoriDivisiController::class, 'updated'])->name('sub_kategori_divisi.updated');
Route::post('/sub_kategori_divisi-delete', [App\Http\Controllers\SubKategoriDivisiController::class, 'delete'])->name('sub_kategori_divisi.delete');

// anggota divisi
Route::resource('anggota_divisi',AnggotaDivisiController::class);
Route::get('/anggota_divisi-getdata', [App\Http\Controllers\AnggotaDivisiController::class, 'getData'])->name('anggota_divisi.getData');
Route::post('/anggota_divisi-updated', [App\Http\Controllers\AnggotaDivisiController::class, 'updated'])->name('anggota_divisi.updated');
Route::post('/anggota_divisi-delete', [App\Http\Controllers\AnggotaDivisiController::class, 'delete'])->name('anggota_divisi.delete');
Route::get('anggota_divisi/{anggota_divisi}/edit',  [App\Http\Controllers\AnggotaDivisiController::class,'edit'])->name('anggota_divisi.edit');

//  divisi
Route::resource('divisi',DivisiController::class);
Route::get('/divisi-getdata', [App\Http\Controllers\DivisiController::class, 'getData'])->name('divisi.getData');
Route::post('/divisi-updated', [App\Http\Controllers\DivisiController::class, 'updated'])->name('divisi.updated');
Route::post('/divisi-delete', [App\Http\Controllers\DivisiController::class, 'delete'])->name('divisi.delete');
Route::get('/divisi-getAnggota', [App\Http\Controllers\DivisiController::class, 'getAnggota'])->name('divisi.getAnggota');

//  dokumen
Route::resource('dokumen',DokumenController::class);
Route::get('/dokumen-getdata', [App\Http\Controllers\DokumenController::class, 'getData'])->name('dokumen.getData');
Route::post('/dokumen-updated', [App\Http\Controllers\DokumenController::class, 'updated'])->name('dokumen.updated');
Route::post('/dokumen-delete', [App\Http\Controllers\DokumenController::class, 'delete'])->name('dokumen.delete');
Route::post('/dokumen-updated-publish', [App\Http\Controllers\DokumenController::class, 'publish'])->name('dokumen.publish');
Route::post('/dokumen-updated-download', [App\Http\Controllers\DokumenController::class, 'download'])->name('dokumen.download');

Route::resource('kategori_dokumen',KategoriDokumenController::class);
Route::get('/kategori_dokumen-getdata', [App\Http\Controllers\KategoriDokumenController::class, 'getData'])->name('kategori_dokumen.getData');
Route::post('/kategori_dokumen-updated', [App\Http\Controllers\KategoriDokumenController::class, 'updated'])->name('kategori_dokumen.updated');
Route::post('/kategori_dokumen-delete', [App\Http\Controllers\KategoriDokumenController::class, 'delete'])->name('kategori_dokumen.delete');

Route::resource('sub_kategori_dokumen',SubKategoriDokumenController::class);
Route::get('/sub_kategori_dokumen-getdata', [App\Http\Controllers\SubKategoriDokumenController::class, 'getData'])->name('sub_kategori_dokumen.getData');
Route::post('/sub_kategori_dokumen-updated', [App\Http\Controllers\SubKategoriDokumenController::class, 'updated'])->name('sub_kategori_dokumen.updated');
Route::post('/sub_kategori_dokumen-delete', [App\Http\Controllers\SubKategoriDokumenController::class, 'delete'])->name('sub_kategori_dokumen.delete');

Route::resource('juduL_gambar_isi',JudulGambarIsiController::class);
Route::get('/juduL_gambar_isi-get_data', [App\Http\Controllers\JudulGambarIsiController::class, 'getData'])->name('juduL_gambar_isi.getData');
Route::post('/juduL_gambar_isi-updated', [App\Http\Controllers\JudulGambarIsiController::class, 'updated'])->name('juduL_gambar_isi.updated');
Route::resource('setting_halaman_utama',SettingHalamanUtamaController::class);

Route::post('/setting_halaman_utama-setting_footer', [App\Http\Controllers\SettingHalamanUtamaController::class, 'setting_footer'])->name('setting_halaman_utama.setting_footer');
Route::post('/setting_halaman_utama-updated', [App\Http\Controllers\SettingHalamanUtamaController::class, 'updated'])->name('setting_halaman_utama.updated');
Route::post('/setting_halaman_utama-delete', [App\Http\Controllers\SettingHalamanUtamaController::class, 'delete'])->name('setting_halaman_utama.delete');
Route::get('/setting_halaman_utama-get_data', [App\Http\Controllers\SettingHalamanUtamaController::class, 'getData'])->name('setting_halaman_utama.getData');
Route::post('/setting_halaman_utama-about', [App\Http\Controllers\SettingHalamanUtamaController::class, 'AboutStore'])->name('setting_halaman_utama.about');

// kategori media
Route::resource('kategori_media',KategoriMediaController::class);
Route::get('/kategori_media-get_data', [App\Http\Controllers\KategoriMediaController::class, 'getData'])->name('kategori_media.getData');
Route::post('/kategori_media-updated', [App\Http\Controllers\KategoriMediaController::class, 'updated'])->name('kategori_media.updated');
Route::post('/kategori_media-delete', [App\Http\Controllers\KategoriMediaController::class, 'delete'])->name('kategori_media.delete');

//media
Route::resource('media',MediaController::class);
Route::get('/media-get_data', [App\Http\Controllers\MediaController::class, 'getData'])->name('media.getData');
Route::post('/media-updated', [App\Http\Controllers\MediaController::class, 'updated'])->name('media.updated');
Route::post('/media-delete', [App\Http\Controllers\MediaController::class, 'delete'])->name('media.delete');

Route::resource('kerjasama',KerjasamaController::class);
Route::get('/kerjasama-get_data', [App\Http\Controllers\KerjasamaController::class, 'getData'])->name('kerjasama.getData');
Route::post('/kerjasama-updated', [App\Http\Controllers\KerjasamaController::class, 'updated'])->name('kerjasama.updated');
Route::post('/kerjasama-delete', [App\Http\Controllers\KerjasamaController::class, 'delete'])->name('kerjasama.delete');

Route::resource('users',UserController::class);
Route::post('/user/update', [UserController::class, 'update'])->name('user.update');


Route::get('/layanan', [FrontendController::class, 'layanan'])
    ->name('frontend.layanan');

Route::get('/akreditasi', [FrontendController::class, 'akreditasi'])
    ->name('frontend.akreditasi');

Route::get('/dokumen-induk', [FrontendController::class, 'dokumenInduk'])
    ->name('frontend.dokumen_induk');

Route::get('/dokumen-mutu', [FrontendController::class, 'dokumenMutu'])
    ->name('frontend.dokumen_mutu');

Route::get('/infografis', [FrontendController::class, 'infografis'])
    ->name('frontend.infografis');

Route::get('/sistem-informasi-mutu', [FrontendController::class, 'sim'])
    ->name('frontend.sim');

