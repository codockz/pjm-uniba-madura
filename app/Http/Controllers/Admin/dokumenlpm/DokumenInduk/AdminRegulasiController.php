<?php

namespace App\Http\Controllers\Admin\dokumenlpm\DokumenInduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Regulasi;
use Illuminate\Support\Facades\Storage;

class AdminRegulasiController extends Controller
{
    // 🔹 TAMPIL DATA
    public function index()
    {
        $data = Regulasi::latest()->get();
        return view('admin.dokumen_lpm.dokumen_induk.regulasi.index', compact('data'));
    }

    // 🔹 SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required',
            'sumber_dokumen' => 'required',
            'nomor' => 'required',
            'tentang' => 'required',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $file = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file')->store('regulasi', 'public');
        }

        Regulasi::create([
            'tahun' => $request->tahun,
            'sumber_dokumen' => $request->sumber_dokumen,
            'nomor' => $request->nomor,
            'tentang' => $request->tentang,
            'file' => $file,
        ]);

        return redirect()->route('admin.regulasi.index')->with('success', 'Data berhasil ditambahkan');
    }

    // 🔹 UPDATE DATA
    public function update(Request $request, $id)
    {
        $data = Regulasi::findOrFail($id);

        $request->validate([
            'tahun' => 'required',
            'sumber_dokumen' => 'required',
            'nomor' => 'required',
            'tentang' => 'required',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // 🔥 UPDATE FILE
        if ($request->hasFile('file')) {
            if ($data->file && Storage::disk('public')->exists($data->file)) {
                Storage::disk('public')->delete($data->file);
            }

            $data->file = $request->file('file')->store('regulasi', 'public');
        }

        // 🔥 UPDATE DATA
        $data->update([
            'tahun' => $request->tahun,
            'sumber_dokumen' => $request->sumber_dokumen,
            'nomor' => $request->nomor,
            'tentang' => $request->tentang,
        ]);

        return redirect()->route('admin.regulasi.index')->with('success', 'Data berhasil diupdate');
    }

    // 🔹 HAPUS DATA
    public function destroy($id)
    {
        $data = Regulasi::findOrFail($id);

        // 🔥 hapus file
        if ($data->file && Storage::disk('public')->exists($data->file)) {
            Storage::disk('public')->delete($data->file);
        }

        $data->delete();

        return redirect()->route('admin.regulasi.index')->with('success', 'Data berhasil dihapus');
    }
}
