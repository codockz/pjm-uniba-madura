<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    public function index()
    {
        $data = ProgramStudi::latest()->get();
        return view('admin.data_master.program_studi.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:program_studis,nama'
        ]);

        ProgramStudi::create([
            'nama' => $request->nama
        ]);

        return redirect()->back()
            ->with('success', 'Program Studi berhasil ditambahkan');
    }

    public function edit(ProgramStudi $programStudi)
    {
        return view('admin.data_master.program_studi.edit', compact('programStudi'));
    }

    public function update(Request $request, ProgramStudi $programStudi)
    {
        $request->validate([
            'nama' => 'required|unique:program_studis,nama,' . $programStudi->id
        ]);

        $programStudi->update([
            'nama' => $request->nama
        ]);

        return redirect()
            ->route('admin.program-studi.index')
            ->with('success', 'Program Studi berhasil diperbarui');
    }

    public function destroy(ProgramStudi $programStudi)
    {
        $programStudi->delete();

        return redirect()->back()
            ->with('success', 'Program Studi berhasil dihapus');
    }
}
