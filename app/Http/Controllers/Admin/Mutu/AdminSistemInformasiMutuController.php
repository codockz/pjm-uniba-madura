<?php

namespace App\Http\Controllers\Admin\Mutu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SistemInformasiMutu;

class AdminSistemInformasiMutuController extends Controller
{
    public function index()
    {
        $data = SistemInformasiMutu::latest()->get();

        return view('admin.SistemMutu.index', compact('data'));
    }

    public function store(Request $request)
    {
        SistemInformasiMutu::create([
            'nama_penyelenggara' => $request->nama_penyelenggara,
            'singkatan' => $request->singkatan,
            'link' => $request->link,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = SistemInformasiMutu::findOrFail($id);

        $data->update([
            'nama_penyelenggara' => $request->nama_penyelenggara,
            'singkatan' => $request->singkatan,
            'link' => $request->link,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = SistemInformasiMutu::findOrFail($id);

        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
