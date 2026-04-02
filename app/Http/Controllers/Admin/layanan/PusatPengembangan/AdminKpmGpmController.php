<?php

namespace App\Http\Controllers\Admin\layanan\PusatPengembangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KpmGpm;


class AdminKpmGpmController extends Controller
{
    public function index()
    {
        $data = KpmGpm::latest()->paginate(5);

        return view('admin.layanan.admin_pusat_pengembangan.kpm_gpm.index', compact('data'));
    }
    public function create()
    {
        return view('admin.layanan.admin_pusat_pengembangan.kpm_gpm.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'file' => 'required|mimes:pdf',
        ]);

        $file = $request->file('file')->store('kpm_gpm', 'public');

        KpmGpm::create([
            'judul' => $request->judul,
            'file' => $file,
        ]);

        return redirect()->route('kpm_gpm.index')->with('success', 'File berhasil diupload');
    }
    public function destroy($id)
    {
        $data = KpmGpm::findOrFail($id);

        $file_path = public_path('upload/kpm_gpm/' . $data->file);

        if (file_exists($file_path)) {
            unlink($file_path);
        }

        $data->delete();

        return redirect()->route('kpm_gpm.index')->with('success', 'Dokumen berhasil dihapus');
    }
}
