<?php

namespace App\Http\Controllers\Admin\layanan\PusatAudit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SurveiPemangku;

class AdminSurveiPemangkuKepentinganController extends Controller
{
    // 🔹 TAMPIL DATA
    public function index()
    {
        $data = SurveiPemangku::latest()->get();
        return view('admin.layanan.Admin_pusat_audit.survei_pemangku.index', compact('data'));
    }

    // 🔹 SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'pengisi' => 'required',
            'kepuasan_text' => 'nullable',
            'link_kepuasan' => 'nullable|url',
            'evaluasi_text' => 'nullable',
            'link_evaluasi' => 'nullable|url',
        ]);

        SurveiPemangku::create([
            'pengisi' => $request->pengisi,
            'kepuasan_text' => $request->kepuasan_text,
            'link_kepuasan' => $request->link_kepuasan,
            'evaluasi_text' => $request->evaluasi_text,
            'link_evaluasi' => $request->link_evaluasi,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    // 🔹 UPDATE DATA
    public function update(Request $request, $id)
    {
        $data = SurveiPemangku::findOrFail($id);

        $request->validate([
            'pengisi' => 'required',
            'kepuasan_text' => 'nullable',
            'link_kepuasan' => 'nullable|url',
            'evaluasi_text' => 'nullable',
            'link_evaluasi' => 'nullable|url',
        ]);

        $data->update([
            'pengisi' => $request->pengisi,
            'kepuasan_text' => $request->kepuasan_text,
            'link_kepuasan' => $request->link_kepuasan,
            'evaluasi_text' => $request->evaluasi_text,
            'link_evaluasi' => $request->link_evaluasi,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    // 🔹 HAPUS DATA
    public function destroy($id)
    {
        $data = SurveiPemangku::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
