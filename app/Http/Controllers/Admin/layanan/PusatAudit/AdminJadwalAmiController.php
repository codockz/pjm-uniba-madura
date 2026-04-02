<?php

namespace App\Http\Controllers\Admin\layanan\PusatAudit;

use App\Models\JadwalAmi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminJadwalAmiController extends Controller
{
    public function index()
    {
        $data = JadwalAmi::latest()->get();

        return view('admin.layanan.admin_pusat_audit.jadwal_ami.index', compact('data'));
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
        $pdfName = 'jadwal-ami-' . $slug . '-' . $request->tahun . '.' . $request->file->extension();

        $cover = $request->file('cover')->storeAs('jadwal_ami/gambar', $coverName, 'public');
        $pdf = $request->file('file')->storeAs('jadwal_ami/pdf', $pdfName, 'public');

        JadwalAmi::create([
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'cover' => $cover,
            'file' => $pdf,
        ]);

        return redirect()->route('jadwal_ami.index')->with('success', 'Data Jadwal AMI berhasil ditambahkan');
    }
    public function update(Request $request, $id)
    {
        $data = JadwalAmi::findOrFail($id);

        $data->judul = $request->judul;
        $data->tahun = $request->tahun;

        if ($request->hasFile('cover')) {
            Storage::disk('public')->delete($data->cover);

            $cover = $request->file('cover')->store('jadwal_ami/cover', 'public');

            $data->cover = $cover;
        }

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($data->file);

            $file = $request->file('file')->store('jadwal_ami/pdf', 'public');

            $data->file = $file;
        }

        $data->save();

        return redirect()->route('jadwal_ami.index')->with('success', 'Data berhasil diupdate');
    }
    public function destroy($id)
    {
        $data = JadwalAmi::findOrFail($id);

        Storage::disk('public')->delete($data->cover);
        Storage::disk('public')->delete($data->file);

        $data->delete();

        return redirect()->route('jadwal_ami.index')->with('success', 'Data berhasil dihapus');
    }
}
