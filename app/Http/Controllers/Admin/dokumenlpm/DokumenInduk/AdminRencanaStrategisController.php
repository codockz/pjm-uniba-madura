<?php

namespace App\Http\Controllers\Admin\dokumenlpm\DokumenInduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RencanaStrategis;
use Illuminate\Support\Facades\Storage;

class AdminRencanaStrategisController extends Controller
{
    public function index()
    {
        $data = RencanaStrategis::latest()->get();

        return view('admin.dokumen_lpm.dokumen_induk.rencana_strategis.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tahun_mulai' => 'required|digits:4',
            'tahun_berakhir' => 'required|digits:4',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        // upload file
        $file = $request->file('file')->store('rencana_strategis', 'public');

        RencanaStrategis::create([
            'judul' => $request->judul,
            'tahun_mulai' => $request->tahun_mulai,
            'tahun_berakhir' => $request->tahun_berakhir,
            'file' => $file,
        ]);

        return back()->with('success', 'Berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'tahun_mulai' => 'required|digits:4',
            'tahun_berakhir' => 'required|digits:4',
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = RencanaStrategis::findOrFail($id);

        // jika upload file baru
        if ($request->hasFile('file')) {
            // hapus file lama
            if ($data->file && Storage::disk('public')->exists($data->file)) {
                Storage::disk('public')->delete($data->file);
            }

            // upload file baru
            $data->file = $request->file('file')->store('rencana_strategis', 'public');
        }

        // update data
        $data->update([
            'judul' => $request->judul,
            'tahun_mulai' => $request->tahun_mulai,
            'tahun_berakhir' => $request->tahun_berakhir,
        ]);

        return back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = RencanaStrategis::findOrFail($id);

        // hapus file dari storage
        if ($data->file && Storage::disk('public')->exists($data->file)) {
            Storage::disk('public')->delete($data->file);
        }

        $data->delete();

        return back()->with('success', 'Berhasil dihapus');
    }
}
