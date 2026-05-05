<?php

namespace App\Http\Controllers\Admin\layanan\PusatAudit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KalenderMutu;
use Illuminate\Support\Facades\Storage;

class AdminKalenderMutuController extends Controller
{
    // 🔹 TAMPIL DATA
    public function index()
    {
        $data = KalenderMutu::orderBy('tahun', 'desc')->latest()->paginate(5);

        return view('admin.layanan.admin_pusat_audit.kalender_mutu.index', compact('data'));
    }

    // 🔹 FORM CREATE
    public function create()
    {
        return view('admin.layanan.admin_pusat_audit.kalender_mutu.create');
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

        $filePath = $request->file('file')->store('kalender_mutu', 'public');

        KalenderMutu::create([
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'file' => $filePath,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.kalender_mutu.index')->with('success', 'Data berhasil ditambahkan');
    }

    // 🔹 UPDATE DATA
    public function update(Request $request, $id)
    {
        $data = KalenderMutu::findOrFail($id);

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

            $filePath = $request->file('file')->store('kalender_mutu', 'public');
            $data->file = $filePath;
        }

        $data->update([
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.kalender_mutu.index')->with('success', 'Data berhasil diupdate');
    }

    // 🔹 HAPUS DATA
    public function destroy($id)
    {
        $data = KalenderMutu::findOrFail($id);

        if ($data->file && Storage::disk('public')->exists($data->file)) {
            Storage::disk('public')->delete($data->file);
        }

        $data->delete();

        return redirect()->route('admin.kalender_mutu.index')->with('success', 'Data berhasil dihapus');
    }

    // 🔥 TOGGLE STATUS
    public function toggle($id)
    {
        $data = KalenderMutu::findOrFail($id);

        $data->is_active = !$data->is_active;
        $data->save();

        return back()->with('success', 'Status berhasil diubah');
    }
}
