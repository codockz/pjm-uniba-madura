<?php

namespace App\Http\Controllers\Admin\dokumenlpm\DokumenMutu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Standar;
use Illuminate\Support\Facades\Storage;

class AdminStandarController extends Controller
{
    // 🔹 TAMPIL DATA
    public function index()
    {
        $data = Standar::latest()->get();
        return view('admin.dokumen_lpm.dokumen_mutu.standar.index', compact('data'));
    }

    // 🔹 SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tahun_terbit' => 'required',
            'revisi' => 'required',
            'file' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('standar', 'public'); // 🔥 ganti folder
        }

        Standar::create([
            'judul' => $request->judul,
            'tahun_terbit' => $request->tahun_terbit,
            'revisi' => $request->revisi,
            'file' => $filePath,
        ]);

        return redirect()->route('admin.standar.index')->with('success', 'Data berhasil ditambahkan');
    }

    // 🔹 UPDATE DATA
    public function update(Request $request, $id)
    {
        $data = Standar::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'tahun_terbit' => 'required',
            'revisi' => 'required',
            'file' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        // 🔥 handle file baru
        if ($request->hasFile('file')) {
            // hapus file lama
            if ($data->file && Storage::disk('public')->exists($data->file)) {
                Storage::disk('public')->delete($data->file);
            }

            $filePath = $request->file('file')->store('standar', 'public'); // 🔥 ganti folder
            $data->file = $filePath;
        }

        $data->update([
            'judul' => $request->judul,
            'tahun_terbit' => $request->tahun_terbit,
            'revisi' => $request->revisi,
        ]);

        return redirect()->route('admin.standar.index')->with('success', 'Data berhasil diupdate');
    }

    // 🔹 HAPUS DATA
    public function destroy($id)
    {
        $data = Standar::findOrFail($id);

        // 🔥 hapus file juga
        if ($data->file && Storage::disk('public')->exists($data->file)) {
            Storage::disk('public')->delete($data->file);
        }

        $data->delete();

        return redirect()->route('admin.standar.index')->with('success', 'Data berhasil dihapus');
    }
}
