<?php

namespace App\Http\Controllers\Admin\layanan\PusatPengembangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuratTugasMonev;
use Illuminate\Support\Facades\Storage;

class AdminSuratTugasMonevController extends Controller
{
    // 🔹 TAMPIL DATA
    public function index()
    {
        $data = SuratTugasMonev::orderBy('tahun', 'desc')->latest()->paginate(5);

        return view('admin.layanan.admin_pusat_pengembangan.surat_tugas_monev.index', compact('data'));
    }

    // 🔹 FORM CREATE
    public function create()
    {
        return view('admin.layanan.admin_pusat_pengembangan.surat_tugas_monev.create');
    }

    // 🔹 SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tahun' => 'nullable|integer',
            'file' => 'required|mimes:pdf|max:2048',
            'is_active' => 'required',
        ]);

        $filePath = $request->file('file')->store('surat_tugas_monev', 'public');

        SuratTugasMonev::create([
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'file' => $filePath,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.surat_tugas_monev.index')->with('success', 'Data berhasil ditambahkan');
    }

    // 🔹 UPDATE DATA
    public function update(Request $request, $id)
    {
        $data = SuratTugasMonev::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'tahun' => 'nullable|integer',
            'file' => 'nullable|mimes:pdf|max:2048',
            'is_active' => 'required',
        ]);

        if ($request->hasFile('file')) {
            if ($data->file && Storage::disk('public')->exists($data->file)) {
                Storage::disk('public')->delete($data->file);
            }

            $filePath = $request->file('file')->store('surat_tugas_monev', 'public');
            $data->file = $filePath;
        }

        $data->update([
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.surat_tugas_monev.index')->with('success', 'Data berhasil diupdate');
    }

    // 🔹 HAPUS DATA
    public function destroy($id)
    {
        $data = SuratTugasMonev::findOrFail($id);

        if ($data->file && Storage::disk('public')->exists($data->file)) {
            Storage::disk('public')->delete($data->file);
        }

        $data->delete();

        return redirect()->route('admin.surat_tugas_monev.index')->with('success', 'Data berhasil dihapus');
    }

    // 🔥 TOGGLE STATUS
    public function toggle($id)
    {
        $data = SuratTugasMonev::findOrFail($id);

        $data->is_active = !$data->is_active;
        $data->save();

        return back()->with('success', 'Status berhasil diubah');
    }
}
