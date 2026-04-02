<?php

namespace App\Http\Controllers\Admin\layanan\PusatAudit;

use Illuminate\Http\Request;
use App\Models\LaporanHasilSurvei;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminLaporanHasilSurveiController extends Controller
{
    public function index()
    {
        $data = LaporanHasilSurvei::latest()->get();

        return view('admin.layanan.Admin_pusat_audit.laporan_hasil_survei.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tahun' => 'required',
            'gambar' => 'required|image',
            'file_pdf' => 'required|mimes:pdf',
        ]);

        $slug = Str::slug($request->judul);

        $gambarName = 'cover-' . $slug . '-' . $request->tahun . '.' . $request->gambar->extension();
        $pdfName = 'laporan-' . $slug . '-' . $request->tahun . '.' . $request->file_pdf->extension();

        $gambar = $request->file('gambar')->storeAs('laporan/gambar', $gambarName, 'public');
        $pdf = $request->file('file_pdf')->storeAs('laporan/pdf', $pdfName, 'public');

        LaporanHasilSurvei::create([
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'gambar' => $gambar,
            'file_pdf' => $pdf,
        ]);

        return redirect()->route('laporan_hasil_survei.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = LaporanHasilSurvei::findOrFail($id);

        $data->judul = $request->judul;
        $data->tahun = $request->tahun;

        if ($request->hasFile('gambar')) {
            Storage::disk('public')->delete($data->gambar);

            $gambar = $request->file('gambar')->store('laporan/gambar', 'public');

            $data->gambar = $gambar;
        }

        if ($request->hasFile('file_pdf')) {
            Storage::disk('public')->delete($data->file_pdf);

            $pdf = $request->file('file_pdf')->store('laporan/pdf', 'public');

            $data->file_pdf = $pdf;
        }

        $data->save();

        return redirect()->route('laporan_hasil_survei.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = LaporanHasilSurvei::findOrFail($id);

        Storage::disk('public')->delete($data->gambar);
        Storage::disk('public')->delete($data->file_pdf);

        $data->delete();

        return redirect()->route('laporan_hasil_survei.index')->with('success', 'Data berhasil dihapus');
    }
}
