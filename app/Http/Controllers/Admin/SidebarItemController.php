<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SidebarItem;
use App\Models\SidebarCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SidebarItemController extends Controller
{
    public function index(Request $request)
    {
        $data = SidebarItem::with('category')->orderBy('urutan')->get();

        $kategori = SidebarCategory::orderBy('urutan')->get();

        $edit = null;

        if ($request->has('edit')) {
            $edit = SidebarItem::find($request->edit);
        }

        return view('admin.sidebar.item.index', compact('data', 'kategori', 'edit'));
    }

    public function create()
    {
        $kategori = SidebarCategory::all();
        return view('admin.sidebar.item.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'category_id' => 'required',
                'judul' => 'required',
                'urutan' => [
                    'required',
                    Rule::unique('sidebar_items')->where(function ($query) use ($request) {
                        return $query->where('category_id', $request->category_id);
                    }),
                ],
            ],
            [
                'urutan.unique' => 'Urutan sudah ada di kategori ini!',
            ],
        );

        SidebarItem::create([
            'category_id' => $request->category_id,
            'judul' => $request->judul,
            'link' => $request->link,
            'urutan' => $request->urutan,
            'is_active' => $request->is_active ?? 1,
        ]);

        return redirect()->route('sidebar-item.index')->with('success', 'Berhasil tambah');
    }

    public function edit($id)
    {
        $data = SidebarItem::findOrFail($id);
        $kategori = SidebarCategory::all();

        return view('admin.sidebar.item.edit', compact('data', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $data = SidebarItem::findOrFail($id);

        $request->validate(
            [
                'category_id' => 'required',
                'judul' => 'required',
                'urutan' => [
                    'required',
                    Rule::unique('sidebar_items')
                        ->where(function ($query) use ($request) {
                            return $query->where('category_id', $request->category_id);
                        })
                        ->ignore($id),
                ],
            ],
            [
                'urutan.unique' => 'Urutan sudah ada di kategori ini!',
            ],
        );

        $data->update([
            'category_id' => $request->category_id,
            'judul' => $request->judul,
            'link' => $request->link,
            'urutan' => $request->urutan,
            'is_active' => $request->is_active ?? 1,
        ]);

        return redirect()->route('sidebar-item.index')->with('success', 'Berhasil update');
    }

    public function destroy($id)
    {
        SidebarItem::findOrFail($id)->delete();
        return back()->with('success', 'Berhasil hapus');
    }
}
