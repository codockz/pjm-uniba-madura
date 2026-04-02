<?php

namespace App\Http\Controllers\Admin\layanan\PusatPengembangan;

use App\Models\LaporanMonev;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLaporanMonevController extends Controller
{
    public function index()
    {
        $data = LaporanMonev::latest()->paginate(6);

        return view('admin.layanan.admin_pusat_pengembangan.laporan_monev.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tahun' => 'required',
            'file' => 'required|mimes:pdf',
        ]);

        $file = $request->file('file')->store('laporan_monev', 'public');

        LaporanMonev::create([
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'file' => $file,
        ]);

        return redirect()->route('laporan_monev.index')->with('success', 'File berhasil diupload');
    }

    public function destroy($id)
    {
        $data = LaporanMonev::findOrFail($id);

        Storage::disk('public')->delete($data->file);

        $data->delete();

        return redirect()->route('laporan_monev.index')->with('success', 'Dokumen berhasil dihapus');
    }
}
