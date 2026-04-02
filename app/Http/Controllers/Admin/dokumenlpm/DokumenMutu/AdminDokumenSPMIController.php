<?php

namespace App\Http\Controllers\Admin\dokumenlpm\DokumenMutu;

use Illuminate\Http\Request;
use App\Models\DokumenSpmi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminDokumenSPMIController extends Controller
{
    public function index()
    {
        $data = DokumenSpmi::latest()->get();
        return view('admin.dokumen_lpm.dokumen_mutu.dokumen_spmi.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'link' => 'required|url',
            'gambar' => 'required|image',
            'deskripsi' => 'nullable',
        ]);

        // upload gambar
        $gambar = $request->file('gambar')->store('spmi/gambar', 'public');

        DokumenSpmi::create([
            'judul' => $request->judul,
            'link' => $request->link,
            'gambar' => $gambar,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = DokumenSpmi::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'link' => 'required|url',
            'gambar' => 'nullable|image',
            'deskripsi' => 'nullable',
        ]);

        $data->judul = $request->judul;
        $data->link = $request->link;
        $data->deskripsi = $request->deskripsi;

        // update gambar
        if ($request->hasFile('gambar')) {
            if ($data->gambar) {
                Storage::disk('public')->delete($data->gambar);
            }

            $gambar = $request->file('gambar')->store('spmi/gambar', 'public');
            $data->gambar = $gambar;
        }

        $data->save();

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = DokumenSpmi::findOrFail($id);

        if ($data->gambar) {
            Storage::disk('public')->delete($data->gambar);
        }

        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
