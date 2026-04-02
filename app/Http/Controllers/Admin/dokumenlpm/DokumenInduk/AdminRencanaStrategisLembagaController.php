<?php

namespace App\Http\Controllers\Admin\dokumenlpm\DokumenInduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RencanaStrategisLembaga;
use Illuminate\Support\Facades\Storage;

class AdminRencanaStrategisLembagaController extends Controller
{
    public function index()
    {
        $data = RencanaStrategisLembaga::latest()->get();

        return view('admin.dokumen_lpm.dokumen_induk.rencana_lembaga.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tahun_mulai' => 'nullable|digits:4',
            'tahun_selesai' => 'nullable|digits:4',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        // upload file
        $file = $request->file('file')->store('rencana_strategis_lembaga', 'public');

        RencanaStrategisLembaga::create([
            'judul' => $request->judul,
            'tahun_mulai' => $request->tahun_mulai,
            'tahun_selesai' => $request->tahun_selesai,
            'file' => $file,
        ]);

        return back()->with('success', 'Berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'tahun_mulai' => 'nullable|digits:4',
            'tahun_selesai' => 'nullable|digits:4',
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = RencanaStrategisLembaga::findOrFail($id);

        // jika upload file baru
        if ($request->hasFile('file')) {
            // hapus file lama
            if ($data->file && Storage::disk('public')->exists($data->file)) {
                Storage::disk('public')->delete($data->file);
            }

            // upload file baru
            $data->file = $request->file('file')->store('rencana_strategis_lembaga', 'public');
        }

        // update data
        $data->update([
            'judul' => $request->judul,
            'tahun_mulai' => $request->tahun_mulai,
            'tahun_selesai' => $request->tahun_selesai,
        ]);

        return back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = RencanaStrategisLembaga::findOrFail($id);

        // hapus file dari storage
        if ($data->file && Storage::disk('public')->exists($data->file)) {
            Storage::disk('public')->delete($data->file);
        }

        $data->delete();

        return back()->with('success', 'Berhasil dihapus');
    }
}
