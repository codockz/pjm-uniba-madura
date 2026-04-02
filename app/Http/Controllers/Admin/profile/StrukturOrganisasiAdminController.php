<?php

namespace App\Http\Controllers\Admin\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StrukturOrganisasiAdminController extends Controller
{
    public function index()
    {
        return view('admin.profile.struktur_organisasi_admin');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $request->file('gambar')->storeAs('struktur', 'struktur.png', 'public');

        return redirect()->route('admin_struktur_organisasi.index')
            ->with('success', 'Berhasil update');
    }
}
