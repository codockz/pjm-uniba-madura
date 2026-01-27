<?php

namespace App\Http\Controllers;

use App\Models\KategoriMedia;
use App\Models\SettingWebProfile;
use App\Models\Media;
use Validator;
use Illuminate\Http\Request;

class KategoriMediaController extends Controller
{

    public function index()
    {
        $title = 'Media PJM';
        $data = KategoriMedia::all();
        $setting = SettingWebProfile::latest()->first();
        if (request()->ajax())
          {
                return datatables()->of($data)
                        ->addColumn('kategori_media', function ($row) {
                           $all = '';
                           $all .= '<span class="editSpan nama_kategori">'.$row->nama_kategori.'</span>';
                           $all .= '<input name="nama_kategori" class="form-control editInput nama_kategori" value="'.$row->nama_kategori.'" style="display:none;">';
                           $all .= '  <div class="invalid-feedback " id="nama_kategori'.$row->id.'-error">

                           </div>';
                           return $all;
                        })
                        ->addColumn('action', function ($row) {
                            $btn = ' <button class="btn text-warning btn-sm edit_kategori"><i
                                        class="fa fa-edit"></i></button>
                                <button class="btn text-black btnSaveKategori btn-sm" style="display: none"><i
                                        class="fa fa-check"></i></button>
                                <button class="btn text-danger editCancelKategori btn-sm" style="display: none"><i
                                        class="fa fa-times"></i></button>
                                <button class="btn btn-danger btn-sm" onclick="deleteDataKategori('.$row->id.')"><i
                                        class="fa fa-trash"></i></button>';

                            return $btn;
                        })
                        ->editColumn('DT_RowId', function ($row) {
                            return $row->id;
                        })
                        ->rawColumns(['action','kategori_media'])
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('pages.media.index',compact('setting','title','data','kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'kategori_media' => 'required',
        ],[
            'kategori_media.required' => 'Kategori Struktur Organisasi harus di isi !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{
            $data = KategoriMedia::create([
                'nama_kategori' => $request->kategori_media,
            ]);

            $isi = KategoriMedia::all();
            return response()->json([
                'status' => 200,
                'message' => 'data berhasil di tambah',
                'data' => $isi,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KategoriMedia  $kategoriMedia
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriMedia $kategoriMedia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KategoriMedia  $kategoriMedia
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriMedia $kategoriMedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KategoriMedia  $kategoriMedia
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'nama_kategori' => 'required',
        ],[
            'nama_kategori.required' => 'Nama Kategori harus di isi !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di update',
                'data' =>  $validate->errors(),
            ]);
        }else{
            $data = KategoriMedia::findOrFail($request->id);
            $data->update([
                'nama_kategori' => $request->nama_kategori,
            ]);
            $isi = KategoriMedia::all();

            return response()->json([
                'status' => 200,
                'message' => 'data berhasil di update',
                'data' =>  $request->nama_kategori,
                'data_select' => $isi
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KategoriMedia  $kategoriMedia
     * @return \Illuminate\Http\Response
     */

        public function delete(Request $request)
    {
        $data = KategoriMedia::findOrFail($request->ids);
        $check = Media::where('kategori_media_id',$data->id)->first();
        if(!is_null($check)){
            return response()->json([
                'status' => 400,
                'error' => 'Kategori terkait dengan Media silahkan hapus terlebih dahulu data Media',
            ]);
        }else{

        }
        if($data->delete()){
            $isi = KategoriMedia::all();
            return response()->json([
                'status' => 200,
                'message' => 'data berhasil di hapus',
                'data' =>  $isi,
            ]);
        }
    }

}
