<?php

namespace App\Http\Controllers\Admin\layanan\PusatAudit;

use Illuminate\Http\Request;
use App\Models\KalenderMutu;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminKalenderMutuController extends Controller
{
    public function index()
    {
        $data = KalenderMutu::latest()->get();

        return view('admin.layanan.Admin_pusat_audit.kalender_mutu.index', compact('data'));
    }

   public function store(Request $request)
{
    $request->validate([
        'judul' => 'required',
        'tahun' => 'required',
        'file' => 'required|mimes:pdf',
    ]);

    // upload file
    $pdf = $request->file('file')->store('kalender_mutu/pdf', 'public');

    // simpan ke database
    \App\Models\KalenderMutu::create([
        'judul' => $request->judul,
        'tahun' => $request->tahun,
        'file' => $pdf, // 🔥 INI PENTING
    ]);

    return redirect()->back()->with('success', 'Data berhasil ditambahkan');
}

    public function update(Request $request, $id)
    {
        $data = KalenderMutu::findOrFail($id);

        $data->judul = $request->judul;
        $data->tahun = $request->tahun;

        if ($request->hasFile('gambar')) {
            Storage::disk('public')->delete($data->gambar);

            $gambar = $request->file('gambar')->store('kalender/gambar', 'public');
            $data->gambar = $gambar;
        }

        if ($request->hasFile('file_pdf')) {
            Storage::disk('public')->delete($data->file_pdf);

            $pdf = $request->file('file_pdf')->store('kalender/pdf', 'public');
            $data->file_pdf = $pdf;
        }

        $data->save();

        return redirect()->route('kalender_mutu.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = KalenderMutu::findOrFail($id);

        Storage::disk('public')->delete($data->gambar);
        Storage::disk('public')->delete($data->file_pdf);

        $data->delete();

        return redirect()->route('kalender_mutu.index')->with('success', 'Data berhasil dihapus');
    }
}
