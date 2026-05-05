<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SidebarCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SidebarCategoryController extends Controller
{
    public function index(Request $request)
    {
        $data = SidebarCategory::orderBy('urutan')->get();

        $edit = null;

        if ($request->has('edit')) {
            $edit = SidebarCategory::find($request->edit);
        }

        return view('admin.sidebar.category.index', compact('data', 'edit'));
    }

    public function create()
    {
        return view('admin.sidebar.category.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_kategori' => 'required|unique:sidebar_categories,nama_kategori',
                'urutan' => 'required|unique:sidebar_categories,urutan',
            ],
            [
                'nama_kategori.unique' => 'Kategori sudah ada, tidak boleh sama!',
                'nama_kategori.required' => 'Nama kategori wajib diisi!',
                'urutan.unique' => 'Urutan sudah digunakan!',
                'urutan.required' => 'Urutan wajib diisi!',
            ],
        );
        SidebarCategory::create([
            'nama_kategori' => $request->nama_kategori,
            'slug' => Str::slug($request->nama_kategori),
            'urutan' => $request->urutan,
            'is_active' => $request->is_active ?? 1,
        ]);

        return redirect()->route('sidebar-category.index')->with('success', 'Berhasil tambah');
    }

    public function edit($id)
    {
        $data = SidebarCategory::findOrFail($id);
        return view('admin.sidebar.category.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nama_kategori' => ['required', Rule::unique('sidebar_categories', 'nama_kategori')->ignore($id)],
                'urutan' => ['required', Rule::unique('sidebar_categories', 'urutan')->ignore($id)],
            ],
            [
                'nama_kategori.unique' => 'Kategori sudah ada!',
                'urutan.unique' => 'Urutan sudah digunakan!',
            ],
        );
        $data = SidebarCategory::findOrFail($id);

        $data->update([
            'nama_kategori' => $request->nama_kategori,
            'slug' => Str::slug($request->nama_kategori),
            'urutan' => $request->urutan,
            'is_active' => $request->is_active ?? 1,
        ]);

        return redirect()->route('sidebar-category.index')->with('success', 'Berhasil update');
    }

    public function destroy($id)
    {
        SidebarCategory::findOrFail($id)->delete();
        return back()->with('success', 'Berhasil hapus');
    }
}
