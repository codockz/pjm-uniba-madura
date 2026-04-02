<?php

namespace App\Http\Controllers\Admin\akreditasi\ProgramStudi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SkAkreditasiProdi;
use Illuminate\Support\Facades\Storage;

class AdminSkAkreditasiController extends Controller
{
    // 🔹 TAMPIL DATA
    public function index()
    {
        $data = SkAkreditasiProdi::latest()->get();
        return view('admin.Akreditasi.Akreditasi_ProgramStudi.index', compact('data'));
    }

    // 🔹 SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'program_studi' => 'required',
            'jenjang' => 'required',
            'sk_izin' => 'nullable|file|mimes:pdf|max:2048',
            'akreditasi' => 'required',
            'sk_akreditasi' => 'nullable|file|mimes:pdf|max:2048',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $skIzinFile = null;
        $skAkreditasiFile = null;
        $sertifikatFile = null;

        if ($request->hasFile('file_sk_izin')) {
            $skIzinFile = $request->file('file_sk_izin')->store('sk_izin', 'public');
        }

        if ($request->hasFile('file_sk_akreditasi')) {
            $skAkreditasiFile = $request->file('file_sk_akreditasi')->store('sk_akreditasi', 'public');
        }

        if ($request->hasFile('file')) {
            $sertifikatFile = $request->file('file')->store('sertifikat', 'public');
        }

        SkAkreditasiProdi::create([
            'program_studi' => $request->program_studi,
            'jenjang' => $request->jenjang,

            'sk_izin_text' => $request->sk_izin_text,
            'file_sk_izin' => $skIzinFile,

            'akreditasi' => $request->akreditasi,

            'sk_akreditasi_text' => $request->sk_akreditasi_text,
            'file_sk_akreditasi' => $skAkreditasiFile,

            'file' => $sertifikatFile,
        ]);

        return redirect()->route('admin.sk_akreditasi_prodi.index')->with('success', 'Data berhasil ditambahkan');
    }
    // 🔹 UPDATE DATA
    public function update(Request $request, $id)
    {
        $data = SkAkreditasiProdi::findOrFail($id);

        $request->validate([
            'program_studi' => 'required',
            'jenjang' => 'required',
            'sk_izin' => 'nullable|file|mimes:pdf|max:2048',
            'akreditasi' => 'required',
            'sk_akreditasi' => 'nullable|file|mimes:pdf|max:2048',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // 🔥 UPDATE SK IZIN
        if ($request->hasFile('sk_izin')) {
            if ($data->sk_izin && Storage::disk('public')->exists($data->sk_izin)) {
                Storage::disk('public')->delete($data->sk_izin);
            }

            $data->sk_izin = $request->file('sk_izin')->store('sk_izin', 'public');
        }

        // 🔥 UPDATE SK AKREDITASI
        if ($request->hasFile('sk_akreditasi')) {
            if ($data->sk_akreditasi && Storage::disk('public')->exists($data->sk_akreditasi)) {
                Storage::disk('public')->delete($data->sk_akreditasi);
            }

            $data->sk_akreditasi = $request->file('sk_akreditasi')->store('sk_akreditasi', 'public');
        }

        // 🔥 UPDATE SERTIFIKAT
        if ($request->hasFile('file')) {
            if ($data->file && Storage::disk('public')->exists($data->file)) {
                Storage::disk('public')->delete($data->file);
            }

            $data->file = $request->file('file')->store('sertifikat', 'public');
        }

        // 🔥 UPDATE DATA TEXT
        $data->update([
            'program_studi' => $request->program_studi,
            'jenjang' => $request->jenjang,
            'akreditasi' => $request->akreditasi,
        ]);

        return redirect()->route('admin.sk_akreditasi_prodi.index')->with('success', 'Data berhasil diupdate');
    }

    // 🔹 HAPUS DATA
    public function destroy($id)
    {
        $data = SkAkreditasiProdi::findOrFail($id);

        // 🔥 hapus semua file
        if ($data->sk_izin && Storage::disk('public')->exists($data->sk_izin)) {
            Storage::disk('public')->delete($data->sk_izin);
        }

        if ($data->sk_akreditasi && Storage::disk('public')->exists($data->sk_akreditasi)) {
            Storage::disk('public')->delete($data->sk_akreditasi);
        }

        if ($data->file && Storage::disk('public')->exists($data->file)) {
            Storage::disk('public')->delete($data->file);
        }

        $data->delete();

        return redirect()->route('admin.sk_akreditasi_prodi.index')->with('success', 'Data berhasil dihapus');
    }
}
