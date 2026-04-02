<?php

namespace App\Http\Controllers\Admin\akreditasi\Institusi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AkreditasiInstitusi;
use Illuminate\Support\Facades\Storage;

class AdminAkreditasiInstitusiController extends Controller
{
    // 🔹 TAMPIL DATA
    public function index()
    {
        $data = AkreditasiInstitusi::latest()->get();
        return view('admin.akreditasi.akreditasi_institusi.index', compact('data'));
    }

    // 🔹 FORM CREATE
    public function create()
    {
        return view('admin.akreditasi.akreditasi_institusi.create');
    }

    // 🔹 SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'nama_pt' => 'required',
            'peringkat' => 'required',
            'nomor_sk' => 'required',
            'tahun_sk' => 'required',
            'tgl_berlaku' => 'required|date',
            'tgl_kadaluarsa' => 'required|date',
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('akreditasi', 'public');
        }

        AkreditasiInstitusi::create([
            'nama_pt' => $request->nama_pt,
            'peringkat' => $request->peringkat,
            'nomor_sk' => $request->nomor_sk,
            'tahun_sk' => $request->tahun_sk,
            'tgl_berlaku' => $request->tgl_berlaku,
            'tgl_kadaluarsa' => $request->tgl_kadaluarsa,
            'file' => $filePath,
        ]);

        return redirect()->route('admin.akreditasi_institusi.index')->with('success', 'Data berhasil ditambahkan');
    }

    // 🔹 FORM EDIT
    public function edit($id)
    {
        $data = AkreditasiInstitusi::findOrFail($id);
        return view('admin.akreditasi.akreditasi_institusi.edit', compact('data'));
    }

    // 🔹 UPDATE DATA
    public function update(Request $request, $id)
    {
        $data = AkreditasiInstitusi::findOrFail($id);

        $request->validate([
            'nama_pt' => 'required',
            'peringkat' => 'required',
            'nomor_sk' => 'required',
            'tahun_sk' => 'required',
            'tgl_berlaku' => 'required|date',
            'tgl_kadaluarsa' => 'required|date',
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        // 🔥 handle file baru
        if ($request->hasFile('file')) {
            // hapus file lama jika ada
            if ($data->file && Storage::disk('public')->exists($data->file)) {
                Storage::disk('public')->delete($data->file);
            }

            $filePath = $request->file('file')->store('akreditasi', 'public');
            $data->file = $filePath;
        }

        $data->update([
            'nama_pt' => $request->nama_pt,
            'peringkat' => $request->peringkat,
            'nomor_sk' => $request->nomor_sk,
            'tahun_sk' => $request->tahun_sk,
            'tgl_berlaku' => $request->tgl_berlaku,
            'tgl_kadaluarsa' => $request->tgl_kadaluarsa,
        ]);

        return redirect()->route('admin.akreditasi_institusi.index')->with('success', 'Data berhasil diupdate');
    }

    // 🔹 HAPUS DATA
    public function destroy($id)
    {
        $data = AkreditasiInstitusi::findOrFail($id);

        // 🔥 hapus file juga
        if ($data->file && Storage::disk('public')->exists($data->file)) {
            Storage::disk('public')->delete($data->file);
        }

        $data->delete();

        return redirect()->route('admin.akreditasi_institusi.index')->with('success', 'Data berhasil dihapus');
    }
}
