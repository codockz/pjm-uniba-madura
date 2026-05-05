<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image',
        ]);

        $gambar = $request->file('gambar')->store('slider', 'public');

        Slider::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
            'link' => $request->link,
        ]);

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('slider', 'public');
            $slider->gambar = $gambar;
        }

        $slider->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'link' => $request->link,
        ]);

        return back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Slider::findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}
