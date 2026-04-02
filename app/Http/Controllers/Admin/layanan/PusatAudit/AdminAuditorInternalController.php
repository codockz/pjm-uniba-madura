<?php

namespace App\Http\Controllers\Admin\layanan\PusatAudit;

use App\Models\AuditorInternal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuditorInternalController extends Controller
{
    public function index()
    {
        $data = AuditorInternal::latest()->get();

        return view('admin.layanan.admin_pusat_audit.daftar_auditor_internal.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'fakultas' => 'required',
        ]);

        AuditorInternal::create([
            'nama' => $request->nama,
            'fakultas' => $request->fakultas,
        ]);

        return redirect()->route('auditor_internal.index')->with('success', 'Data Auditor berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = AuditorInternal::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'fakultas' => 'required',
        ]);

        $data->update([
            'nama' => $request->nama,
            'fakultas' => $request->fakultas,
        ]);

        return redirect()->route('auditor_internal.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = AuditorInternal::findOrFail($id);
        $data->delete();

        return redirect()->route('auditor_internal.index')->with('success', 'Data berhasil dihapus');
    }
}
