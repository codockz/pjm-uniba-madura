<?php

namespace App\Http\Controllers\Admin\akreditasi\Mekanisme;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MekanismeAkreditasi;

class AdminMekanismePengajuanAkreditasiController extends Controller
{
    public function index()
    {
        $data = MekanismeAkreditasi::latest()->get();

        return view('admin.Akreditasi.mekanisme_pengajuan.index', compact('data'));
    }

    public function store(Request $request)
    {
        MekanismeAkreditasi::create([
            'nama_penyelenggara' => $request->nama_penyelenggara,
            'singkatan' => $request->singkatan,
            'link' => $request->link,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = MekanismeAkreditasi::findOrFail($id);

        $data->update([
            'nama_penyelenggara' => $request->nama_penyelenggara,
            'singkatan' => $request->singkatan,
            'link' => $request->link,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = MekanismeAkreditasi::findOrFail($id);

        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
