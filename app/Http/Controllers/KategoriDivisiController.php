<?php

namespace App\Http\Controllers;

use App\Models\KategoriDivisi;
use App\Models\SubKategoriDivisi;
use App\Models\Divisi;
use Illuminate\Http\Request;
use App\Models\SettingWebProfile;
use Validator;


class KategoriDivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Divisi';
        $data = KategoriDivisi::all();
        $setting = SettingWebProfile::latest()->first();
        if (request()->ajax())
          {
                return datatables()->of($data)
                        ->addColumn('kategori_divisi', function ($row) {
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
                        ->rawColumns(['action','kategori_divisi'])
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('pages.divisi.index',compact('setting','title','data','kategori'));
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
            'nama_kategori' => 'required|unique:kategori_divisis',
        ],[
            'nama_kategori.required' => 'Kategori Divisi harus di isi !',
            'nama_kategori.unique' => 'Kategori Divisi sudah ada !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{
            $data = KategoriDivisi::create([
                'nama_kategori' => $request->nama_kategori,
            ]);
            $isi = KategoriDivisi::all()->toArray();
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
     * @param  \App\Models\KategoriDivisi  $kategoriDivisi
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriDivisi $kategoriDivisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KategoriDivisi  $kategoriDivisi
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriDivisi $kategoriDivisi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KategoriDivisi  $kategoriDivisi
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
            $data = KategoriDivisi::findOrFail($request->id);
            $data->update([
                'nama_kategori' => $request->nama_kategori,
            ]);
            $isi = KategoriDivisi::all();
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
     * @param  \App\Models\KategoriDivisi  $kategoriDivisi
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $data = KategoriDivisi::findOrFail($request->ids);
        $check = SubKategoriDivisi::where('kategori_divisi_id',$data->id)->first();
        if(!is_null($check)){
            return response()->json([
                'status' => 400,
                'errors' => 'Kategori Divisi terkait data Divisi silahkan hapus terlebih dahulu data Divisi !',
            ]);
        }else{
            if($data->delete()){
                $isi = KategoriDivisi::all();
                return response()->json([
                    'status' => 200,
                    'message' => 'data berhasil di hapus',
                    'data' =>  $isi,
                ]);
            }
        }

    }
}
