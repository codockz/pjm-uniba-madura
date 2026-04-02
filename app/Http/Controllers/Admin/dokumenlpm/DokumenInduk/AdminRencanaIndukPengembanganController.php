<?php

namespace App\Http\Controllers\Admin\dokumenlpm\DokumenInduk;

use Illuminate\Http\Request;
use App\Models\RencanaIndukPengembangan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminRencanaIndukPengembanganController extends Controller
{
    public function index()
    {
        $data = RencanaIndukPengembangan::latest()->get();

        return view('admin.dokumen_lpm.dokumen_induk.rencana_induk.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tahun' => 'required',
            'gambar' => 'required|image',
            'file' => 'required|mimes:pdf',
        ]);

        $slug = Str::slug($request->judul);

        $gambarName = 'cover-' . $slug . '-' . $request->tahun . '.' . $request->gambar->extension();
        $pdfName = 'rip-' . $slug . '-' . $request->tahun . '.' . $request->file->extension();

        $gambar = $request->file('gambar')->storeAs('rip/gambar', $gambarName, 'public');
        $pdf = $request->file('file')->storeAs('rip/pdf', $pdfName, 'public');

        RencanaIndukPengembangan::create([
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'gambar' => $gambar,
            'file' => $pdf,
        ]);

        return redirect()->route('admin.rencana_induk_pengembangan.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = RencanaIndukPengembangan::findOrFail($id);

        $data->judul = $request->judul;
        $data->tahun = $request->tahun;

        if ($request->hasFile('gambar')) {
            Storage::disk('public')->delete($data->gambar);

            $gambar = $request->file('gambar')->store('rip/gambar', 'public');
            $data->gambar = $gambar;
        }

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($data->file);

            $pdf = $request->file('file')->store('rip/pdf', 'public');
            $data->file = $pdf;
        }

        $data->save();

        return redirect()->route('admin.rencana_induk_pengembangan.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = RencanaIndukPengembangan::findOrFail($id);

        Storage::disk('public')->delete($data->gambar);
        Storage::disk('public')->delete($data->file);

        $data->delete();

        return redirect()->route('admin.rencana_induk_pengembangan.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
