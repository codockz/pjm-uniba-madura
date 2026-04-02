<?php

namespace App\Http\Controllers\Admin\layanan\PusatAudit;

use App\Models\JadwalRtm;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class AdminJadwalRtmController extends Controller
{
    public function index()
    {
        $data = JadwalRtm::latest()->get();

        return view('admin.layanan.admin_pusat_audit.jadwal_rtm.index', compact('data'));
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

        $coverName = 'cover-rtm-' . $slug . '-' . $request->tahun . '.' . $request->cover->extension();
        $pdfName = 'jadwal-rtm-' . $slug . '-' . $request->tahun . '.' . $request->file->extension();

        $cover = $request->file('cover')->storeAs('jadwal_rtm/gambar', $coverName, 'public');
        $pdf = $request->file('file')->storeAs('jadwal_rtm/pdf', $pdfName, 'public');

        JadwalRtm::create([
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'cover' => $cover,
            'file' => $pdf,
        ]);

        return redirect()->route('jadwal_rtm.index')->with('success', 'Data Jadwal RTM berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = JadwalRtm::findOrFail($id);

        $data->judul = $request->judul;
        $data->tahun = $request->tahun;

        if ($request->hasFile('cover')) {
            Storage::disk('public')->delete($data->cover);

            $cover = $request->file('cover')->store('jadwal_rtm/gambar', 'public');

            $data->cover = $cover;
        }

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($data->file);

            $pdf = $request->file('file')->store('jadwal_rtm/pdf', 'public');

            $data->file = $pdf;
        }

        $data->save();

        return redirect()->route('jadwal_rtm.index')->with('success', 'Data Jadwal RTM berhasil diupdate');
    }
    public function destroy($id)
    {
        $data = JadwalRtm::findOrFail($id);

        Storage::disk('public')->delete($data->cover);
        Storage::disk('public')->delete($data->file);

        $data->delete();

        return redirect()->route('laporan_ami.index')->with('success', 'Data laporan AMI berhasil dihapus');
    }
}
