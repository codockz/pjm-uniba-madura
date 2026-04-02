<?php

namespace App\Http\Controllers\Admin\layanan\PusatAudit;

use Illuminate\Http\Request;
use App\Models\LaporanAmi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminLaporanAmiController extends Controller
{
    public function index()
    {
        $data = LaporanAmi::latest()->get();

        return view('admin.layanan.admin_pusat_audit.laporan_ami.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tahun' => 'required',
            'cover' => 'required|image',
            'file' => 'required|mimes:pdf',
        ]);

        $slug = Str::slug($request->judul);

        $coverName = 'cover-ami-' . $slug . '-' . $request->tahun . '.' . $request->cover->extension();
        $pdfName = 'laporan-ami-' . $slug . '-' . $request->tahun . '.' . $request->file->extension();

        $cover = $request->file('cover')->storeAs('laporan_ami/gambar', $coverName, 'public');
        $pdf = $request->file('file')->storeAs('laporan_ami/pdf', $pdfName, 'public');

        LaporanAmi::create([
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'cover' => $cover,
            'file' => $pdf,
        ]);

        return redirect()->route('laporan_ami.index')->with('success', 'Data laporan AMI berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = LaporanAmi::findOrFail($id);

        $data->judul = $request->judul;
        $data->tahun = $request->tahun;

        if ($request->hasFile('cover')) {
            Storage::disk('public')->delete($data->cover);

            $cover = $request->file('cover')->store('laporan_ami/gambar', 'public');

            $data->cover = $cover;
        }

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($data->file);

            $pdf = $request->file('file')->store('laporan_ami/pdf', 'public');

            $data->file = $pdf;
        }

        $data->save();

        return redirect()->route('laporan_ami.index')->with('success', 'Data laporan AMI berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = LaporanAmi::findOrFail($id);

        Storage::disk('public')->delete($data->cover);
        Storage::disk('public')->delete($data->file);

        $data->delete();

        return redirect()->route('laporan_ami.index')->with('success', 'Data laporan AMI berhasil dihapus');
    }
}
