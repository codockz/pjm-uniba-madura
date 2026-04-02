<?php

namespace App\Http\Controllers\Admin\layanan\PusatPengembangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuratTugasMonev;
use Illuminate\Support\Facades\Storage;

class AdminSuratTugasMonevController extends Controller
{
    public function index()
    {
        $data = SuratTugasMonev::latest()->paginate(5);

        return view('admin.layanan.admin_pusat_pengembangan.surat_tugas_monev.index', compact('data'));
    }

    public function create()
    {
        return view('admin.layanan.admin_pusat_pengembangan.surat_tugas_monev.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tahun' => 'required',
            'file' => 'required|mimes:pdf',
        ]);

        $file = $request->file('file');

        $nama_file = time() . '_' . $file->getClientOriginalName();

        $path = $file->storeAs('surat_tugas_monev', $nama_file, 'public');

        SuratTugasMonev::create([
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'file' => $path,
        ]);
        return redirect()->route('surat_tugas_monev.index')->with('success', 'File berhasil diupload');
    }

    public function destroy($id)
    {
        $data = SuratTugasMonev::findOrFail($id);

        Storage::disk('public')->delete($data->file);

        $data->delete();

        return redirect()->route('surat_tugas_monev.index')->with('success', 'Dokumen berhasil dihapus');
    }
}
