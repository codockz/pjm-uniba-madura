<?php

namespace App\Http\Controllers\Admin\layanan\PusatPengembangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiklusSpmi;
use App\Models\SpmiDiagram;

class AdminSiklusSpmiController extends Controller
{
    public function index()
{
    $data = SiklusSpmi::orderBy('urutan')->get();
    $diagram = SpmiDiagram::first();

    return view(
        'admin.layanan.admin_pusat_pengembangan.siklus_spmi.index',
        compact('data','diagram')
    );
}

    public function create()
    {
        return view('admin.layanan.admin_pusat_pengembangan.siklus_spmi.create');
    }

    public function store(Request $request)
    {
        SiklusSpmi::create([
            'urutan' => $request->urutan,
            'nama_tahap' => $request->nama_tahap,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.siklus-spmi.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = SiklusSpmi::findOrFail($id);

        $data->update([
            'urutan' => $request->urutan,
            'nama_tahap' => $request->nama_tahap,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }
    public function destroy($id)
    {
        $data = SiklusSpmi::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
    public function uploadDiagram(Request $request)
    {
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/spmi'), $namaFile);

            SpmiDiagram::updateOrCreate(['id' => 1], ['gambar' => $namaFile]);
        }

        return back()->with('success', 'Diagram berhasil diupload');
    }
}
