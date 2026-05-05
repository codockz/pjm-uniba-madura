<?php

namespace App\Http\Controllers\Admin\layanan\PusatAudit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PedomanSertifikasiDosen;
use Illuminate\Support\Facades\Storage;

class AdminPedomanSertifikasiDosenController extends Controller
{
    // 🔹 TAMPIL DATA
    public function index()
    {
        $data = PedomanSertifikasiDosen::orderBy('urutan')->get();

        return view('admin.layanan.Admin_pusat_audit.pedoman_sertifikasi_dosen.index', compact('data'));
    }

    // 🔹 SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required', // 🔥 tambahan
            'judul' => 'required',
            'file' => 'required|file|mimes:pdf|max:2048',
            'urutan' => 'nullable|integer',
        ]);

        $file = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file')->store('pedoman_sertifikasi_dosen', 'public');
        }

        PedomanSertifikasiDosen::create([
            'label' => $request->label, // 🔥 tambahan
            'judul' => $request->judul,
            'file' => $file,
            'urutan' => $request->urutan,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    // 🔹 UPDATE DATA
    public function update(Request $request, $id)
    {
        $data = PedomanSertifikasiDosen::findOrFail($id);

        $request->validate([
            'label' => 'required', // 🔥 tambahan
            'judul' => 'required',
            'file' => 'nullable|file|mimes:pdf|max:2048',
            'urutan' => 'nullable|integer',
        ]);

        // 🔥 UPDATE FILE
        if ($request->hasFile('file')) {

            // hapus file lama
            if ($data->file && Storage::disk('public')->exists($data->file)) {
                Storage::disk('public')->delete($data->file);
            }

            $data->file = $request->file('file')->store('pedoman_sertifikasi_dosen', 'public');
        }

        // 🔥 UPDATE DATA
        $data->update([
            'label' => $request->label, // 🔥 tambahan
            'judul' => $request->judul,
            'urutan' => $request->urutan,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    // 🔹 HAPUS DATA
    public function destroy($id)
    {
        $data = PedomanSertifikasiDosen::findOrFail($id);

        // 🔥 hapus file
        if ($data->file && Storage::disk('public')->exists($data->file)) {
            Storage::disk('public')->delete($data->file);
        }

        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
