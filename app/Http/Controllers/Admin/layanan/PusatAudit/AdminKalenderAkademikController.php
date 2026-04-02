<?php

namespace App\Http\Controllers\Admin\layanan\PusatAudit;

use Illuminate\Http\Request;
use App\Models\KalenderAkademik;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminKalenderAkademikController extends Controller
{
    public function index()
    {
        $data = KalenderAkademik::latest()->get();

        return view('admin.layanan.Admin_pusat_audit.kalender_akademik.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $pdfName = 'kalender-akademik-' . $request->tahun . '.' . $request->file->extension();

        $pdf = $request->file('file')->storeAs('kalender_akademik', $pdfName, 'public');

        KalenderAkademik::create([
            'tahun' => $request->tahun,
            'file' => $pdf,
        ]);

        return redirect()->route('admin.kalender_akademik.index')->with('success', 'Data kalender akademik berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = KalenderAkademik::findOrFail($id);

        $data->tahun = $request->tahun;

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($data->file);

            $pdfName = 'kalender-akademik-' . $request->tahun . '.' . $request->file->extension();

            $pdf = $request->file('file')->storeAs('kalender_akademik', $pdfName, 'public');

            $data->file = $pdf;
        }

        $data->save();

        return redirect()->route('admin.kalender_akademik.index')->with('success', 'Data kalender akademik berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = KalenderAkademik::findOrFail($id);

        Storage::disk('public')->delete($data->file);

        $data->delete();

        return redirect()->route('admin.kalender_akademik.index')->with('success', 'Data kalender akademik berhasil dihapus');
    }
}
