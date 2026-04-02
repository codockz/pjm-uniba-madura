<?php

namespace App\Http\Controllers\Admin\layanan\PusatAudit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SertifikasiDosen;

class AdminSertifikasiDosenController extends Controller
{
    public function index()
    {
        $data = SertifikasiDosen::latest()->get();

        return view('admin.layanan.admin_pusat_audit.sertifikasi_dosen.index', compact('data'));
    }

    public function store(Request $request)
    {
        $file = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file')->store('sertifikasi_dosen', 'public');
        }

        SertifikasiDosen::create([
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'file' => $file,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = SertifikasiDosen::findOrFail($id);

        // cek jika upload file baru
        if ($request->hasFile('file')) {
            // hapus file lama jika ada
            if ($data->file && file_exists(storage_path('app/public/' . $data->file))) {
                unlink(storage_path('app/public/' . $data->file));
            }

            $file = $request->file('file')->store('sertifikasi_dosen', 'public');
        } else {
            $file = $data->file;
        }

        $data->update([
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'file' => $file,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = SertifikasiDosen::findOrFail($id);

        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
