<?php

namespace App\Http\Controllers\Admin\dokumenlpm\DokumenInduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StatuaOrtaker;
use App\Models\StatuaOrtakerImage;
use Illuminate\Support\Facades\Storage;

class AdminStatuaOrtakerController extends Controller
{
    public function index()
    {
        $data = StatuaOrtaker::orderBy('urutan')->get();
        $image = StatuaOrtakerImage::first();

        return view(
            'admin.dokumen_lpm.dokumen_induk.statua_ortaker.index',
            compact('data', 'image')
        );
    }


    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'urutan' => 'required|numeric',
            'file' => 'required|mimes:pdf|max:2048'
        ]);

        $file = $request->file('file');
        $namaFile = time() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('uploads/statuta'), $namaFile);

        StatuaOrtaker::create([
            'judul' => $request->judul,
            'file' => $namaFile,
            'urutan' => $request->urutan
        ]);

        return back()->with('success', 'Data berhasil ditambahkan');
    }


    public function update(Request $request, $id)
    {
        $data = StatuaOrtaker::findOrFail($id);

        if ($request->hasFile('file')) {

            // hapus file lama
            if ($data->file && file_exists(public_path('uploads/statuta/' . $data->file))) {
                unlink(public_path('uploads/statuta/' . $data->file));
            }

            $file = $request->file('file');
            $namaFile = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/statuta'), $namaFile);

            $data->file = $namaFile;
        }

        $data->update([
            'judul' => $request->judul,
            'urutan' => $request->urutan,
            'file' => $data->file
        ]);

        return back()->with('success', 'Data berhasil diupdate');
    }


    public function destroy($id)
    {
        $data = StatuaOrtaker::findOrFail($id);

        if ($data->file && file_exists(public_path('uploads/statuta/' . $data->file))) {
            unlink(public_path('uploads/statuta/' . $data->file));
        }

        $data->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }


    public function uploadImage(Request $request)
    {
        if ($request->hasFile('gambar')) {

            $file = $request->file('gambar');
            $namaFile = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/statuta'), $namaFile);

            // update atau replace
            StatuaOrtakerImage::updateOrCreate(
                ['id' => 1],
                ['gambar' => $namaFile]
            );
        }

        return back()->with('success', 'Gambar berhasil diupload');
    }
}
