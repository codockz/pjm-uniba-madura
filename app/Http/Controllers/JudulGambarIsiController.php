<?php

namespace App\Http\Controllers;

use App\Models\JudulGambarIsi;
use App\Models\SettingWebProfile;
use Illuminate\Http\Request;
use Validator;
class JudulGambarIsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $title = 'Setting Halaman Utama';
      $setting = SettingWebProfile::latest()->first();
      $data =  JudulGambarIsi::all();
      if (request()->ajax())
          {
            return datatables()->of($data)
                    ->addColumn('judul', function ($row) {
                        return $row->judul;
                    })
                    ->addColumn('isi', function ($row) {
                        return $row->isi;
                    })
                    ->editColumn('gambar_halaman_lain', function ($row) {
                        return '<img src="'.asset('file_gambar_halaman_lain').'/'.$row->gambar.'" width="100" height="100">';
                    })
                    ->addColumn('action', function ($row) {
                        $btn = '<button class="btn btn-warning btn-sm edit-button" data-toggle="modal" data-target="#editModalJudulGambarIsi" data-id="'.$row->id.'"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm"  onclick="deleteJudulGambarIsi('.$row->id.')"><i
                                    class="fa fa-trash"></i></button>';

                        return $btn;
                    })
                    ->editColumn('DT_RowId', function ($row) {
                        return $row->id;
                    })
                    ->rawColumns(['action','gambar_halaman_lain'])
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('pages.setting_halaman_utama.index',compact('setting','title','data'));
    }

    public function getData(Request $request)
    {

        $data = JudulGambarIsi::findOrFail($request->data);
        return response()->json([
            'data' =>  $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg,gif,svg',


        ],[
            'judul.required' => 'Judul harus di isi !',
            'isi.required' => 'Isi harus di isi !',
            'gambar.required' => 'Gambar harus di isi !',
            'gambar.image' => 'Gambar harus type jpg,png,jpeg,gif,svg !',
            'gambar.mimes' => 'Gambar harus type jpg,png !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{


            $file_gambar = $request->file('gambar');
            $gambar = time() . '_' . $file_gambar->getClientOriginalName();
            $destinationPath = public_path('file_gambar_halaman_lain');

            if ($file_gambar->move($destinationPath, $gambar)) {
                $save = JudulGambarIsi::create([
                    'judul' => $request->judul,
                    'isi' => $request->isi,
                    'gambar' => $gambar,
                    'kategori' => $request->kategori,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'data berhasil di tambah',
                ]);
            } else {
                // Handle file moving failure
                Log::error("Failed to move file '{$file_gambar->getClientOriginalName()}' to '{$destinationPath}'.");
                // You can also inform the user about the error
                return response()->json(['error' => 'Failed to upload image. Please try again later.'], 500);
            }


        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JudulGambarIsi  $JudulGambarIsi
     * @return \Illuminate\Http\Response
     */
    public function show(JudulGambarIsi $JudulGambarIsi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JudulGambarIsi  $JudulGambarIsi
     * @return \Illuminate\Http\Response
     */
    public function edit(JudulGambarIsi $JudulGambarIsi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JudulGambarIsi  $JudulGambarIsi
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        // dd($request->all());
        $validate = Validator::make($request->all(),[
            'judul_gambar_isi_edit' => 'required',
            'judul_isi_edit' => 'required',
            'gambar' => 'image|mimes:jpg,png,jpeg,gif,svg',


        ],[
            'judul_gambar_isi_edit.required' => 'Judul  harus di isi !',
            'judul_isi_edit.required' => 'Isi harus di isi !',
            'gambar.image' => 'Gambar  harus type jpg,png,jpeg,gif,svg !',
            'gambar.mimes' => 'Gambar  harus type jpg,png !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di update',
                'data' =>  $validate->errors(),
            ]);
        }else{


            $file_gambar = $request->file('gambar');
            if(is_null($request->old_gambar)){
                $gambar = time() . '-' . $file_gambar->getClientOriginalName();
                $file_gambar->move(public_path('file_gambar_halaman_lain'), $gambar);
            }else{
                $gambar = $request->old_gambar;
                if(!is_null($file_gambar)){
                    $path = public_path('file_gambar_halaman_lain/').$request->old_gambar;
                    if(unlink($path)){
                        $gambar = time() . '_' . $file_gambar->getClientOriginalName();
                        $file_gambar->move(public_path('file_gambar_halaman_lain'), $gambar);
                    }
                }
            }

            $save = JudulGambarIsi::findOrFail($request->id);
            $save->update([
                'judul' => $request->judul_gambar_isi_edit,
                'isi' => $request->judul_isi_edit,
                'gambar' => $gambar,
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'data berhasil di update',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JudulGambarIsi  $JudulGambarIsi
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
{
    $data = JudulGambarIsi::find($request->ids);

    if ($data) {
        $data->delete();
    }

    return response()->json([
        'message' => 'Data berhasil dihapus'
    ]);
}
}
