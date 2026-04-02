<?php

namespace App\Http\Controllers\Admin\DokumenLpm\DokumenMutu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sop;
use Illuminate\Support\Facades\Storage;

class AdminSopController extends Controller
{
    public function index()
    {
        $data = Sop::latest()->get();

        return view('admin.dokumen_lpm.dokumen_mutu.sop.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tahun' => 'nullable',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        // upload file
        $file = $request->file('file')->store('sop', 'public');

        Sop::create([
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'file' => $file,
        ]);

        return back()->with('success', 'Berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'tahun' => 'nullable',
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = Sop::findOrFail($id);

        // jika upload file baru
        if ($request->hasFile('file')) {
            // hapus file lama
            if ($data->file && Storage::disk('public')->exists($data->file)) {
                Storage::disk('public')->delete($data->file);
            }

            // upload file baru
            $data->file = $request->file('file')->store('sop', 'public');
        }

        // update data
        $data->update([
            'judul' => $request->judul,
            'tahun' => $request->tahun,
        ]);

        return back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = Sop::findOrFail($id);

        // hapus file dari storage
        if ($data->file && Storage::disk('public')->exists($data->file)) {
            Storage::disk('public')->delete($data->file);
        }

        $data->delete();

        return back()->with('success', 'Berhasil dihapus');
    }
}
