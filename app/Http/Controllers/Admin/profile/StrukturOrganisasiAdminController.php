<?php

namespace App\Http\Controllers\Admin\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StrukturOrganisasiGambar;
use App\Models\StrukturOrganisasiDeskripsi;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiAdminController extends Controller
{
    public function index()
    {
        $gambar = StrukturOrganisasiGambar::first();
        $data = StrukturOrganisasiDeskripsi::orderBy('urutan')->get();

        return view('admin.profile.struktur_organisasi_admin', compact('gambar', 'data'));
    }

    // 🔹 UPLOAD GAMBAR (SAMAKAN DENGAN SPMI)
    public function upload(Request $request)
    {
        if ($request->hasFile('gambar')) {

            $file = $request->file('gambar');
            $namaFile = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/struktur'), $namaFile);

            StrukturOrganisasiGambar::updateOrCreate(
                ['id' => 1],
                ['gambar' => $namaFile]
            );
        }

        return back()->with('success', 'Gambar berhasil diupload');
    }

    // 🔹 TAMBAH DESKRIPSI
    public function store(Request $request)
    {
        StrukturOrganisasiDeskripsi::create([
            'urutan' => $request->urutan,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    // 🔹 UPDATE DESKRIPSI
    public function update(Request $request, $id)
    {
        $data = StrukturOrganisasiDeskripsi::findOrFail($id);

        $data->update([
            'urutan' => $request->urutan,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    // 🔹 DELETE DESKRIPSI
    public function destroy($id)
    {
        $data = StrukturOrganisasiDeskripsi::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
