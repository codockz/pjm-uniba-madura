<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\
{   SettingWebProfileController,
    ProfileController,
    PetugasPersonaliaController,
    PersonaliaController,
    KategoriTupoksiPjmController,
    TupoksiPjmController,
    KategoriStrukturOrganisasiController,
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

//datamaster
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\frontend\Layanan\PusatAudit\DaftarAuditorInternalController;
use App\Http\Controllers\frontend\Layanan\PusatAudit\JadwalAmiController;
use App\Http\Controllers\frontend\Layanan\PusatAudit\JadwalRtmController;
use App\Http\Controllers\frontend\Layanan\PusatAudit\KalenderMutuController;
use App\Http\Controllers\frontend\Layanan\PusatAudit\KalenderAkademikController;
use App\Http\Controllers\frontend\Layanan\PusatAudit\LaporanAmiController;
use App\Http\Controllers\frontend\Layanan\PusatAudit\LaporanHasilSurveiController;
use App\Http\Controllers\frontend\Layanan\PusatAudit\SertifikasiDosenController;
use App\Http\Controllers\frontend\layanan\PusatAudit\SurveiPemangkuController;
use App\Http\Controllers\frontend\Layanan\PusatPengembangan\DaftarAsesorBKDController;
use App\Http\Controllers\frontend\Layanan\PusatPengembangan\KpmGpmController;
use App\Http\Controllers\frontend\Layanan\PusatPengembangan\LaporanMonevController;
use App\Http\Controllers\frontend\Layanan\PusatPengembangan\SiklusSPMIController;
use App\Http\Controllers\frontend\Layanan\PusatPengembangan\SuratTugasMonevController;
use App\Http\Controllers\frontend\akreditasi\akreditasi_institusi\AkreditasiInstitusiController;
use App\Http\Controllers\frontend\akreditasi\akreditasi_program_studi\SkAkreditasiController;
use App\Http\Controllers\frontend\dokumenlpm\DokumenInduk\RegulasiController;
use App\Http\Controllers\frontend\dokumenlpm\DokumenInduk\KebijakanRektorController;
use App\Http\Controllers\frontend\dokumenlpm\DokumenInduk\RencanaIndukPengembanganController;
use App\Http\Controllers\frontend\dokumenlpm\DokumenInduk\RencanaStrategisController;
use App\Http\Controllers\frontend\dokumenlpm\DokumenInduk\RencanaStrategisLembagaController;
use App\Http\Controllers\frontend\dokumenlpm\DokumenInduk\RencanaOperasionalController;
use App\Http\Controllers\frontend\dokumenlpm\DokumenInduk\StatuaOrtakerController;
use App\Http\Controllers\frontend\dokumenlpm\DokumenMutu\DokumenSPMIController;
use App\Http\Controllers\frontend\dokumenlpm\DokumenMutu\PedomanController;
use App\Http\Controllers\frontend\dokumenlpm\DokumenMutu\StandarController;
use App\Http\Controllers\frontend\dokumenlpm\DokumenMutu\SopController;

use App\Http\Controllers\frontend\profil\ProfilPjmController;
use App\Http\Controllers\frontend\profil\VisiDanMisiController;
use App\Http\Controllers\frontend\profil\StrukturOrganisasiController;
use App\Http\Controllers\admin\profile\StrukturOrganisasiAdminController;
use App\Http\Controllers\admin\Profile\ProfilePjmAdminController;
use App\Http\Controllers\admin\profile\VisiDanMisiAdminController;
use App\Http\Controllers\admin\layanan\PusatPengembangan\DaftarAsesorBKDAdminController;
use App\Http\Controllers\Admin\layanan\PusatPengembangan\AdminKpmGpmController;
use App\Http\Controllers\Admin\layanan\PusatPengembangan\AdminSuratTugasMonevController;
use App\Http\Controllers\Admin\layanan\PusatPengembangan\AdminSiklusSpmiController;
use App\Http\Controllers\Admin\layanan\PusatPengembangan\AdminLaporanMonevController;
use App\Http\Controllers\Admin\layanan\PusatAudit\AdminLaporanHasilSurveiController;
use App\Http\Controllers\Admin\layanan\PusatAudit\AdminKalenderMutuController;
use App\Http\Controllers\Admin\layanan\PusatAudit\AdminLaporanAmiController;
use App\Http\Controllers\Admin\layanan\PusatAudit\AdminJadwalRtmController;
use App\Http\Controllers\Admin\layanan\PusatAudit\AdminJadwalAmiController;
use App\Http\Controllers\Admin\layanan\PusatAudit\AdminAuditorInternalController;
use App\Http\Controllers\Admin\layanan\PusatAudit\AdminSertifikasiDosenController;
use App\Http\Controllers\Admin\layanan\PusatAudit\AdminSurveiPemangkuKepentinganController;
use App\Http\Controllers\Admin\layanan\PusatAudit\AdminKalenderAkademikController;
use App\Http\Controllers\Admin\akreditasi\Institusi\AdminAkreditasiInstitusiController;
use App\Http\Controllers\Admin\akreditasi\ProgramStudi\AdminSkAkreditasiController;
use App\Http\Controllers\Admin\dokumenlpm\DokumenInduk\AdminRegulasiController;
use App\Http\Controllers\Admin\dokumenlpm\DokumenInduk\AdminKebijakanRektorController;
use App\Http\Controllers\Admin\dokumenlpm\DokumenInduk\AdminRencanaIndukPengembanganController;
use App\Http\Controllers\Admin\dokumenlpm\DokumenInduk\AdminRencanaStrategisController;
use App\Http\Controllers\Admin\dokumenlpm\DokumenInduk\AdminRencanaStrategisLembagaController;
use App\Http\Controllers\Admin\dokumenlpm\DokumenInduk\AdminRencanaOperasionalController;
use App\Http\Controllers\Admin\dokumenlpm\DokumenInduk\AdminStatuaOrtakerController;
use App\Http\Controllers\Admin\dokumenlpm\DokumenMutu\AdminDokumenSPMIController;
use App\Http\Controllers\Admin\dokumenlpm\DokumenMutu\AdminPedomanController;
use App\Http\Controllers\Admin\dokumenlpm\DokumenMutu\AdminStandarController;
use App\Http\Controllers\Admin\dokumenlpm\DokumenMutu\AdminSopController;
use App\Models\KebijakanRektor;

Route::get('/', [App\Http\Controllers\FrontendController::class, 'frontend'])->name('frontend.frontend');
//data master

//calender sidebar
Route::get('/arsip/{year}/{month}', [FrontendController::class, 'byMonth']);
Route::get('/arsip/{year}/{month}', [FrontendController::class, 'byMonth'])
    ->where([
        'year' => '[0-9]+',
        'month' => '[0-9]+',
    ])
    ->name('frontend.byMonth');




//profil
// frontend profil
Route::get('/profile/profile-pjm', [ProfilPjmController::class, 'profilePjm'])->name('frontend.profile_pjm');
Route::get('/profile/visi-dan-misi', [VisiDanMisiController::class, 'VisiMisiTujuan'])->name('frontend.visi_dan_misi');
Route::get('/profile/struktur-organisasi', [StrukturOrganisasiController::class, 'Struktur_Organisasi'])->name('frontend.struktur_organisasi');

//layanan
// Pusat Pengembangan Standar Mutu
Route::get('/daftar-asesor-bkd', [DaftarAsesorBKDController::class, 'index'])->name('frontend.daftar_asesor_bkd');
Route::get('/siklus-spmi', [SiklusSPMIController::class, 'index'])->name('frontend.siklus_spmi');
Route::get('/kpm-gpm', [KpmGpmController::class, 'index'])->name('frontend.kpm_gpm');
Route::get('/surat-tugas-monev', [SuratTugasMonevController::class, 'index'])->name('frontend.surat_tugas_monev');
Route::get('/laporan-monev', [LaporanMonevController::class, 'index'])->name('frontend.laporan_monev');
// Pusat Audit mutu
Route::get('/laporan-hasil-survei/{tahun}',[LaporanHasilSurveiController::class, 'index'])->name('frontend.laporan_hasil_survei');
Route::get('/laporan-ami/{tahun}',[LaporanAmiController::class, 'index'])->name('frontend.laporan_ami');



Route::get('/jadwal-rtm', [JadwalRtmController::class, 'index'])->name('frontend.jadwal_rtm');
Route::get('/jadwal-ami', [JadwalAmiController::class, 'index'])->name('frontend.jadwal_ami');
Route::get('/daftar-auditor-internal', [DaftarAuditorInternalController::class, 'index'])->name('frontend.daftar_auditor_internal');
Route::get('/sertifikasi-dosen', [SertifikasiDosenController::class, 'index'])->name('frontend.sertifikasi_dosen');

Route::get('/kalender-mutu/{tahun}',[KalenderMutuController::class, 'index'])->name('frontend.kalender_mutu');
Route::get('/kalender-akademik/{tahun}', [KalenderAkademikController::class, 'index']) ->name('frontend.kalender_akademik');
Route::get('/jadwal-rtm', [JadwalRtmController::class, 'index'])->name('frontend.jadwal_rtm');
Route::get('/survei-pemangku', [SurveiPemangkuController::class, 'index'])->name('frontend.survei_pemangku');

//Frontend Siklus SPMI
Route::prefix('layanan')->name('frontend.layanan.')->group(function () {
Route::get('/siklus-spmi', [SiklusSPMIController::class, 'index'])->name('siklus-spmi');


});





//akreditasi
Route::get('/akreditasi-institusi', [AkreditasiInstitusiController::class, 'index'])->name('frontend.akreditasi_institusi');
Route::get('/sk-akreditasi-program-studi', [SkAkreditasiController::class, 'index'])->name('frontend.akreditasi_program_studi');

//dokumen induk
Route::get('/regulasi', [RegulasiController::class, 'index'])->name('frontend.regulasi');
Route::get('/kebijakan-rektor', [KebijakanRektorController::class, 'index'])->name('frontend.kebijakan_rektor');
Route::get('/rencana-induk-pengembangan', [RencanaIndukPengembanganController::class, 'index'])->name('frontend.rencana_induk_pengembangan');
Route::get('/rencana-strategis', [RencanaStrategisController::class, 'index'])->name('frontend.rencana_strategis');
Route::get('/rencana-strategis-lembaga', [RencanaStrategisLembagaController::class, 'index'])->name('frontend.rencana_strategis_lembaga');
Route::get('/rencana-operasional', [RencanaOperasionalController::class, 'index'])->name('frontend.rencana_operasional');
Route::get('/statua-ortaker', [StatuaOrtakerController::class, 'index'])->name('frontend.statua_ortaker');

//dokumen mutu
Route::get('/dokumen-spmi', [DokumenSPMIController::class, 'index'])->name('frontend.dokumen_spmi');
Route::get('/pedoman', [PedomanController::class, 'index'])->name('frontend.pedoman');
Route::get('/standar', [StandarController::class, 'index'])->name('frontend.standar');
Route::get('/sop', [SopController::class, 'index'])->name('frontend.sop');

//statistik
Route::get('/statistik-dosen', function () {return view('frontend.statistik.data_dosen.index');})->name('statistik.dosen');
Route::get('/statistik-mahasiswa', function () {return view('frontend.statistik.data_mahasiswa.index');})->name('statistik.mahasiswa');

// frontend dokumen Mutu
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
// Route::get('/sistem-satu', [App\Http\Controllers\FrontendController::class, 'SistemSatu'])->name('frontend.satu');
// Route::get('/sistem-ami', [App\Http\Controllers\FrontendController::class, 'SistemAmi'])->name('frontend.sistem_ami');
// Route::get('/laporan-instrumen-ami', [App\Http\Controllers\FrontendController::class, 'InstrumenAmi'])->name('frontend.instrumen_ami');
// Route::get('/pedoman', [App\Http\Controllers\FrontendController::class, 'pedoman'])->name('frontend.pedoman');

// frontend sistem penjaminan mutu
// Route::get('/dokumen-spmi', [App\Http\Controllers\FrontendController::class, 'DokumenSpmi'])->name('frontend.dokumen_spmi');
Route::get('/laporan-kegiatan', [App\Http\Controllers\FrontendController::class, 'LaporanKegiatan'])->name('frontend.laporan_kegiatan');
// Route::get('/laporan-monev', [App\Http\Controllers\FrontendController::class, 'LaporanMonev'])->name('frontend.laporan_monev');

// // media
Route::get('/media-berita/{slug}', [App\Http\Controllers\FrontendController::class, 'mediaBertia'])->name('frontend.showBerita');
Route::get('/media-pengumuman/{slug}', [App\Http\Controllers\FrontendController::class, 'mediaPengumuman'])->name('frontend.showPengumuman');
// Route::get('/media-agenda/{slug}', [App\Http\Controllers\FrontendController::class, 'mediaAgenda'])->name('frontend.showAgenda');

Route::get('/pengumuman', [App\Http\Controllers\FrontendController::class, 'pengumuman'])->name('frontend.pengumuman');
Route::get('/berita', [App\Http\Controllers\FrontendController::class, 'berita'])->name('frontend.berita');
Route::get('/foto', [App\Http\Controllers\FrontendController::class, 'foto'])->name('frontend.foto');
// Route::get('/agenda', [App\Http\Controllers\FrontendController::class, 'agenda'])->name('frontend.agenda');

Auth::routes();
// -- admin -- //
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('setting_web', SettingWebProfileController::class);

// profile
Route::resource('profile', ProfilePjmAdminController::class);
Route::get('/get-data', [ProfilePjmAdminController::class, 'getData'])->name('getData');
Route::post('/profile-updated', [ProfilePjmAdminController::class, 'updated'])->name('profile-updated');
Route::post('/profile-delete', [ProfilePjmAdminController::class, 'delete'])->name('profile-delete');


//master data
Route::prefix('admin')->name('admin.')->group(function () {
Route::resource('program-studi', ProgramStudiController::class);});

//layanan
//Daftar Asesor BKD Admin
Route::prefix('admin')->name('admin.')->group(function () {
Route::get('/daftar-asesor-bkd',[DaftarAsesorBKDAdminController::class, 'index'])->name('daftar_asesor_bkd.index');
Route::get('/daftar-asesor-bkd/create', [DaftarAsesorBKDAdminController::class, 'create'])->name('daftar_asesor_bkd.create');
Route::post('/daftar-asesor-bkd', [DaftarAsesorBKDAdminController::class, 'store'])->name('daftar_asesor_bkd.store');
Route::get('/daftar-asesor-bkd/{id}/edit', [DaftarAsesorBKDAdminController::class, 'edit'])->name('daftar_asesor_bkd.edit');
Route::put('/daftar-asesor-bkd/{id}', [DaftarAsesorBKDAdminController::class, 'update'])->name('daftar_asesor_bkd.update');
Route::delete('/daftar-asesor-bkd/{id}', [DaftarAsesorBKDAdminController::class, 'destroy'])->name('daftar_asesor_bkd.destroy');});

//siklus SPMI Admin
Route::prefix('admin')->group(function () {
Route::get('/siklus-spmi', [AdminSiklusSpmiController::class, 'index'])->name('admin.siklus-spmi.index');
Route::get('/siklus-spmi/create', [AdminSiklusSpmiController::class, 'create'])->name('admin.siklus-spmi.create');
Route::post('/siklus-spmi/store', [AdminSiklusSpmiController::class, 'store'])->name('admin.siklus-spmi.store');});
Route::put('/admin/siklus-spmi/update/{id}', [AdminSiklusSpmiController::class, 'update'])->name('admin.siklus-spmi.update');
Route::delete('/admin/siklus-spmi/delete/{id}', [AdminSiklusSpmiController::class, 'destroy'])->name('admin.siklus-spmi.destroy');
Route::post('/admin/siklus-spmi/upload-diagram', [AdminSiklusSpmiController::class, 'uploadDiagram'])->name('admin.siklus-spmi.uploadDiagram');


Route::prefix('admin')->group(function () {
Route::resource('kpm_gpm', AdminKpmGpmController::class);
Route::resource('surat_tugas_monev', AdminSuratTugasMonevController::class);
Route::resource('laporan_monev', AdminLaporanMonevController::class);
Route::resource('laporan_hasil_survei', AdminLaporanHasilSurveiController::class);
Route::resource('laporan_ami', AdminLaporanAmiController::class);
Route::resource('jadwal_rtm', AdminJadwalRtmController::class);
Route::resource('jadwal_ami', AdminJadwalAmiController::class);
Route::resource('auditor_internal', AdminAuditorInternalController::class);
Route::resource('sertifikasi_dosen', AdminSertifikasiDosenController::class);
Route::resource('kalender_mutu', AdminKalenderMutuController::class);
Route::resource('survei_pemangku', AdminSurveiPemangkuKepentinganController::class);
});

Route::prefix('admin')->name('admin.')->group(function () {
Route::resource('akreditasi_institusi', AdminAkreditasiInstitusiController::class);
Route::resource('sk_akreditasi_prodi', AdminSkAkreditasiController::class);
Route::resource('kalender_akademik', AdminKalenderAkademikController::class);
});

Route::prefix('admin')->name('admin.')->group(function () {
Route::resource('regulasi', AdminRegulasiController::class);
Route::resource('kebijakan_rektor', AdminKebijakanRektorController::class);
Route::resource('rencana_induk_pengembangan', AdminRencanaIndukPengembanganController::class);
Route::resource('rencana_strategis', AdminRencanaStrategisController::class);
Route::resource('rencana_strategis_lembaga', AdminRencanaStrategisLembagaController::class);
Route::resource('rencana_operasional', AdminRencanaOperasionalController::class);
Route::resource('statua_ortakers', AdminStatuaOrtakerController::class);
Route::post('/statua-ortaker/upload-image', [AdminStatuaOrtakerController::class, 'uploadImage'])->name('statua_ortaker_images');
});

Route::prefix('admin')->name('admin.')->group(function () {
Route::resource('dokumen_spmi', AdminDokumenSPMIController::class);
Route::resource('pedoman', AdminPedomanController::class);
Route::resource('standar', AdminStandarController::class);
Route::resource('sop', AdminSopController::class);
});

// //kategori personalia
// Route::resource('kategori_personalia', KategoriPersonaliaController::class);
// Route::get('/kategori_personalia-get_data', [App\Http\Controllers\KategoriPersonaliaController::class, 'getData'])->name('kategori_personalia.getData');
// Route::post('/kategori_personalia-updated', [App\Http\Controllers\KategoriPersonaliaController::class, 'updated'])->name('kategori_personalia.updated');
// Route::post('/kategori_personalia-delete', [App\Http\Controllers\KategoriPersonaliaController::class, 'delete'])->name('kategori_personalia.delete');

// kategori tupoksi-pjpm
Route::resource('kategori_tupoksi_pjm', KategoriTupoksiPjmController::class);
Route::get('/kategori_tupoksi_pjm-get_data', [App\Http\Controllers\KategoriTupoksiPjmController::class, 'getData'])->name('kategori_tupoksi_pjm.getData');
Route::post('/kategori_tupoksi_pjm-updated', [App\Http\Controllers\KategoriTupoksiPjmController::class, 'updated'])->name('kategori_tupoksi_pjm.updated');
Route::post('/kategori_tupoksi_pjm-delete', [App\Http\Controllers\KategoriTupoksiPjmController::class, 'delete'])->name('kategori_tupoksi_pjm.delete');

// tupoksi-pjpm
Route::resource('tupoksi_pjm', TupoksiPjmController::class);
Route::get('/tupoksi_pjm-get_data', [App\Http\Controllers\TupoksiPjmController::class, 'getData'])->name('tupoksi_pjm.getData');
Route::post('/tupoksi_pjm-updated', [App\Http\Controllers\TupoksiPjmController::class, 'updated'])->name('tupoksi_pjm.updated');
Route::post('/tupoksi_pjm-delete', [App\Http\Controllers\TupoksiPjmController::class, 'delete'])->name('tupoksi_pjm.delete');

// kategori struktur organisasi
Route::resource('kategori_struktur_organisasi', KategoriStrukturOrganisasiController::class);
Route::get('/kategori_struktur_organisasi-get_data', [App\Http\Controllers\KategoriStrukturOrganisasiController::class, 'getData'])->name('kategori_struktur_organisasi.getData');
Route::post('/kategori_struktur_organisasi-updated', [App\Http\Controllers\KategoriStrukturOrganisasiController::class, 'updated'])->name('kategori_struktur_organisasi.updated');
Route::post('/kategori_struktur_organisasi-delete', [App\Http\Controllers\KategoriStrukturOrganisasiController::class, 'delete'])->name('kategori_struktur_organisasi.delete');

// STRUKTUR ORGANISASI
// ADMIN STRUKTUR ORGANISASI
Route::get('/admin_struktur_organisasi', [StrukturOrganisasiAdminController::class, 'index'])->name('admin_struktur_organisasi.index');
Route::post('/admin_struktur_organisasi', [StrukturOrganisasiAdminController::class, 'upload'])->name('admin_struktur_organisasi.upload');

// visi misi tujuan
Route::resource('visi_misi_tujuan', VisiDanMisiAdminController::class);
Route::get('/visi_misi_tujuan-get_data', [VisiDanMisiAdminController::class, 'getData'])->name('visi_misi_tujuan.getData');
Route::post('/visi_misi_tujuan-updated', [VisiDanMisiAdminController::class, 'updated'])->name('visi_misi_tujuan.updated');
Route::post('/visi_misi_tujuan-delete', [VisiDanMisiAdminController::class, 'delete'])->name('visi_misi_tujuan.delete');



// kategori divisi
Route::resource('kategori_divisi', KategoriDivisiController::class);
Route::get('/kategori_divisi-get_data', [App\Http\Controllers\KategoriDivisiController::class, 'getData'])->name('kategori_divisi.getData');
Route::post('/kategori_divisi-updated', [App\Http\Controllers\KategoriDivisiController::class, 'updated'])->name('kategori_divisi.updated');
Route::post('/kategori_divisi-delete', [App\Http\Controllers\KategoriDivisiController::class, 'delete'])->name('kategori_divisi.delete');
// sub kategori divisi
Route::resource('sub_kategori_divisi', SubKategoriDivisiController::class);
Route::get('/sub_kategori_divisi-getdata', [App\Http\Controllers\SubKategoriDivisiController::class, 'getData'])->name('sub_kategori_divisi.getData');
Route::post('/sub_kategori_divisi-updated', [App\Http\Controllers\SubKategoriDivisiController::class, 'updated'])->name('sub_kategori_divisi.updated');
Route::post('/sub_kategori_divisi-delete', [App\Http\Controllers\SubKategoriDivisiController::class, 'delete'])->name('sub_kategori_divisi.delete');

// anggota divisi
Route::resource('anggota_divisi', AnggotaDivisiController::class);
Route::get('/anggota_divisi-getdata', [App\Http\Controllers\AnggotaDivisiController::class, 'getData'])->name('anggota_divisi.getData');
Route::post('/anggota_divisi-updated', [App\Http\Controllers\AnggotaDivisiController::class, 'updated'])->name('anggota_divisi.updated');
Route::post('/anggota_divisi-delete', [App\Http\Controllers\AnggotaDivisiController::class, 'delete'])->name('anggota_divisi.delete');
Route::get('anggota_divisi/{anggota_divisi}/edit', [App\Http\Controllers\AnggotaDivisiController::class, 'edit'])->name('anggota_divisi.edit');

//  divisi
Route::resource('divisi', DivisiController::class);
Route::get('/divisi-getdata', [App\Http\Controllers\DivisiController::class, 'getData'])->name('divisi.getData');
Route::post('/divisi-updated', [App\Http\Controllers\DivisiController::class, 'updated'])->name('divisi.updated');
Route::post('/divisi-delete', [App\Http\Controllers\DivisiController::class, 'delete'])->name('divisi.delete');
Route::get('/divisi-getAnggota', [App\Http\Controllers\DivisiController::class, 'getAnggota'])->name('divisi.getAnggota');

//  dokumen
Route::resource('dokumen', DokumenController::class);
Route::get('/dokumen-getdata', [App\Http\Controllers\DokumenController::class, 'getData'])->name('dokumen.getData');
Route::post('/dokumen-updated', [App\Http\Controllers\DokumenController::class, 'updated'])->name('dokumen.updated');
Route::post('/dokumen-delete', [App\Http\Controllers\DokumenController::class, 'delete'])->name('dokumen.delete');
Route::post('/dokumen-updated-publish', [App\Http\Controllers\DokumenController::class, 'publish'])->name('dokumen.publish');
Route::post('/dokumen-updated-download', [App\Http\Controllers\DokumenController::class, 'download'])->name('dokumen.download');

Route::resource('kategori_dokumen', KategoriDokumenController::class);
Route::get('/kategori_dokumen-getdata', [App\Http\Controllers\KategoriDokumenController::class, 'getData'])->name('kategori_dokumen.getData');
Route::post('/kategori_dokumen-updated', [App\Http\Controllers\KategoriDokumenController::class, 'updated'])->name('kategori_dokumen.updated');
Route::post('/kategori_dokumen-delete', [App\Http\Controllers\KategoriDokumenController::class, 'delete'])->name('kategori_dokumen.delete');

Route::resource('sub_kategori_dokumen', SubKategoriDokumenController::class);
Route::get('/sub_kategori_dokumen-getdata', [App\Http\Controllers\SubKategoriDokumenController::class, 'getData'])->name('sub_kategori_dokumen.getData');
Route::post('/sub_kategori_dokumen-updated', [App\Http\Controllers\SubKategoriDokumenController::class, 'updated'])->name('sub_kategori_dokumen.updated');
Route::post('/sub_kategori_dokumen-delete', [App\Http\Controllers\SubKategoriDokumenController::class, 'delete'])->name('sub_kategori_dokumen.delete');

Route::resource('juduL_gambar_isi', JudulGambarIsiController::class);
Route::get('/juduL_gambar_isi-get_data', [App\Http\Controllers\JudulGambarIsiController::class, 'getData'])->name('juduL_gambar_isi.getData');
Route::post('/juduL_gambar_isi-updated', [App\Http\Controllers\JudulGambarIsiController::class, 'updated'])->name('juduL_gambar_isi.updated');
Route::resource('setting_halaman_utama', SettingHalamanUtamaController::class);

Route::post('/setting_halaman_utama-setting_footer', [App\Http\Controllers\SettingHalamanUtamaController::class, 'setting_footer'])->name('setting_halaman_utama.setting_footer');
Route::post('/setting_halaman_utama-updated', [App\Http\Controllers\SettingHalamanUtamaController::class, 'updated'])->name('setting_halaman_utama.updated');
Route::post('/setting_halaman_utama-delete', [App\Http\Controllers\SettingHalamanUtamaController::class, 'delete'])->name('setting_halaman_utama.delete');
Route::get('/setting_halaman_utama-get_data', [App\Http\Controllers\SettingHalamanUtamaController::class, 'getData'])->name('setting_halaman_utama.getData');
Route::post('/setting_halaman_utama-about', [App\Http\Controllers\SettingHalamanUtamaController::class, 'AboutStore'])->name('setting_halaman_utama.about');

// kategori media
Route::resource('kategori_media', KategoriMediaController::class);
Route::get('/kategori_media-get_data', [App\Http\Controllers\KategoriMediaController::class, 'getData'])->name('kategori_media.getData');
Route::post('/kategori_media-updated', [App\Http\Controllers\KategoriMediaController::class, 'updated'])->name('kategori_media.updated');
Route::post('/kategori_media-delete', [App\Http\Controllers\KategoriMediaController::class, 'delete'])->name('kategori_media.delete');

//media
Route::resource('media', MediaController::class);
Route::get('/media-get_data', [App\Http\Controllers\MediaController::class, 'getData'])->name('media.getData');
Route::post('/media-updated', [App\Http\Controllers\MediaController::class, 'updated'])->name('media.updated');
Route::post('/media-delete', [App\Http\Controllers\MediaController::class, 'delete'])->name('media.delete');

Route::resource('kerjasama', KerjasamaController::class);
Route::get('/kerjasama-get_data', [App\Http\Controllers\KerjasamaController::class, 'getData'])->name('kerjasama.getData');
Route::post('/kerjasama-updated', [App\Http\Controllers\KerjasamaController::class, 'updated'])->name('kerjasama.updated');
Route::post('/kerjasama-delete', [App\Http\Controllers\KerjasamaController::class, 'delete'])->name('kerjasama.delete');

Route::resource('users', UserController::class);
Route::post('/user/update', [UserController::class, 'update'])->name('user.update');

// LAYANAN =================
