<?php

namespace App\Http\Controllers\Admin\dokumenlpm\DokumenInduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KebijakanRektor;
use Illuminate\Support\Facades\Storage;

class AdminKebijakanRektorController extends Controller
{
    public function index()
    {
        $data = KebijakanRektor::latest()->get();
        return view('admin.dokumen_lpm.dokumen_induk.kebijakan_rektor.index', compact('data'));
    }

    public function store(Request $request)
    {
        $file = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file')->store('kebijakan_rektor', 'public');
        }

        KebijakanRektor::create([
            'tahun' => $request->tahun,
            'nomor' => $request->nomor,
            'dokumen' => $request->dokumen,
            'tentang' => $request->tentang,
            'tanggal_terbit' => $request->tanggal_terbit,
            'file' => $file,
        ]);

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = KebijakanRektor::findOrFail($id);

        if ($request->hasFile('file')) {
            if ($data->file && Storage::disk('public')->exists($data->file)) {
                Storage::disk('public')->delete($data->file);
            }

            $data->file = $request->file('file')->store('kebijakan_rektor', 'public');
        }

        $data->update([
            'tahun' => $request->tahun,
            'nomor' => $request->nomor,
            'dokumen' => $request->dokumen,
            'tentang' => $request->tentang,
            'tanggal_terbit' => $request->tanggal_terbit,
        ]);

        return back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = KebijakanRektor::findOrFail($id);

        if ($data->file && Storage::disk('public')->exists($data->file)) {
            Storage::disk('public')->delete($data->file);
        }

        $data->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
