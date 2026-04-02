<?php

namespace App\Http\Controllers\Admin\dokumenlpm\DokumenInduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RencanaOperasional;
use Illuminate\Support\Facades\Storage;

class AdminRencanaOperasionalController extends Controller
{
    public function index()
    {
        $data = RencanaOperasional::latest()->get();
        return view('admin.dokumen_lpm.dokumen_induk.rencana_operasional.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $file = $request->file('file')->store('rencana_operasional', 'public');

        RencanaOperasional::create([
            'judul' => $request->judul,
            'file' => $file,
        ]);

        return back()->with('success', 'Berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = RencanaOperasional::findOrFail($id);

        // jika upload file baru
        if ($request->hasFile('file')) {
            // hapus file lama
            if ($data->file && Storage::disk('public')->exists($data->file)) {
                Storage::disk('public')->delete($data->file);
            }

            // simpan file baru
            $data->file = $request->file('file')->store('rencana_operasional', 'public');
        }

        // update data
        $data->update([
            'judul' => $request->judul,
        ]);

        return back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = RencanaOperasional::findOrFail($id);

        if ($data->file && Storage::disk('public')->exists($data->file)) {
            Storage::disk('public')->delete($data->file);
        }

        $data->delete();

        return back()->with('success', 'Berhasil dihapus');
    }
}
