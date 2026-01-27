<?php

namespace App\Http\Controllers;

use App\Models\KategoriDokumen;
use App\Models\SubKategoriDokumen;
use App\Models\Dokumen;
use App\Models\SettingWebProfile;
use Validator;

use Illuminate\Http\Request;

class KategoriDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Dokumen';
        $data = KategoriDokumen::all();
        $setting = SettingWebProfile::latest()->first();
        if (request()->ajax())
          {
                return datatables()->of($data)
                        ->addColumn('kategori_dokumen', function ($row) {
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
                        ->rawColumns(['action','kategori_dokumen'])
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('pages.dokumen.index',compact('setting','title','data','kategori'));
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
            'nama_kategori' => 'required|unique:kategori_dokumens',
        ],[
            'nama_kategori.required' => 'Kategori Dokumen harus di isi !',
            'nama_kategori.unique' => 'Kategori Dokumen sudah ada !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{
            $data = KategoriDokumen::create([
                'nama_kategori' => $request->nama_kategori,
            ]);
            $isi = KategoriDokumen::all()->toArray();
            return response()->json([
                'status' => 200,
                'message' => 'data berhasil di tambah',
                'data_select' => $isi
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KategoriDokumen  $kategoriDokumen
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriDokumen $kategoriDokumen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KategoriDokumen  $kategoriDokumen
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriDokumen $kategoriDokumen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KategoriDokumen  $kategoriDokumen
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
            $data = KategoriDokumen::findOrFail($request->id);
            $data->update([
                'nama_kategori' => $request->nama_kategori,
            ]);

            $isi = KategoriDokumen::all();
            // dd($isi);
            return response()->json([
                'status' => 200,
                'message' => 'data berhasil di update',
                'data' =>  $request->nama_kategori,
                'data_select' => $isi,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KategoriDokumen  $kategoriDokumen
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $data = KategoriDokumen::findOrFail($request->ids);
        $check = SubKategoriDokumen::where('kategori_dokumen_id',$data->id)->first();
        if(!is_null($check)){
            return response()->json([
                'status' => 400,
                'message' => 'Kategori Terkait dengan Sub Kategori Hapus Terlebih Dahulu Sub kategori !',
                'data' =>  '',
            ]);
        }else{
            if($data->delete()){
                $isi = KategoriDokumen::all();
                return response()->json([
                    'status' => 200,
                    'message' => 'data berhasil di hapus',
                    'data' =>  $isi,
                ]);
            }
        }
    }
}
