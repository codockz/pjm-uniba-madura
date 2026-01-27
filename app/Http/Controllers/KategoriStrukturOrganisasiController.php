<?php

namespace App\Http\Controllers;

use App\Models\KategoriStrukturOrganisasi;
use App\Models\StrukturOrganisasi;
use App\Models\SettingWebProfile;
use Illuminate\Http\Request;
use Validator;

class KategoriStrukturOrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Tupoksi PJM';
        $data = KategoriStrukturOrganisasi::all();
        $setting = SettingWebProfile::latest()->first();
        if (request()->ajax())
          {
                return datatables()->of($data)
                        ->addColumn('kategori_struktur', function ($row) {
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
                        ->rawColumns(['action','kategori_struktur'])
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('pages.struktur_organisasi.index',compact('setting','title','data','kategori'));
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
            'kategori_struktur_organisasi' => 'required',
        ],[
            'kategori_struktur_organisasi.required' => 'Kategori Struktur Organisasi harus di isi !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{
            $data = KategoriStrukturOrganisasi::create([
                'nama_kategori' => $request->kategori_struktur_organisasi,
            ]);

            $isi = KategoriStrukturOrganisasi::all();
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
     * @param  \App\Models\KategoriStrukturOrganisasi  $kategoriStrukturOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriStrukturOrganisasi $kategoriStrukturOrganisasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KategoriStrukturOrganisasi  $kategoriStrukturOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriStrukturOrganisasi $kategoriStrukturOrganisasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KategoriStrukturOrganisasi  $kategoriStrukturOrganisasi
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
            $data = KategoriStrukturOrganisasi::findOrFail($request->id);
            $data->update([
                'nama_kategori' => $request->nama_kategori,
            ]);
            $isi = KategoriStrukturOrganisasi::all();

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
     * @param  \App\Models\KategoriStrukturOrganisasi  $kategoriStrukturOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $data = KategoriStrukturOrganisasi::findOrFail($request->ids);
        $check = StrukturOrganisasi::where('kategori_struktur_id',$data->id)->first();
        if(!is_null($check)){
            return response()->json([
                'status' => 400,
                'error' => 'Kategori terkait dengan struktur organisasi silahkan hapus terlebih dahulu data struktur organisasi',
            ]);
        }else{

        }
        if($data->delete()){
            $isi = KategoriStrukturOrganisasi::all();
            return response()->json([
                'status' => 200,
                'message' => 'data berhasil di hapus',
                'data' =>  $isi,
            ]);
        }
    }
}
