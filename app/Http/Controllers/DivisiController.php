<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\KategoriDivisi;
use App\Models\SubKategoriDivisi;
use App\Models\AnggotaDivisi;
use Illuminate\Http\Request;
use App\Models\SettingWebProfile;
use Validator;


class DivisiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Divisi';
        $kategori = KategoriDivisi::all();
        $subkategori = SubKategoriDivisi::all();
        $selectsubkategori = SubKategoriDivisi::leftJoin('kategori_divisis','kategori_divisis.id','sub_kategori_divisis.kategori_divisi_id')
                                              ->select('sub_kategori_divisis.*','kategori_divisis.nama_kategori')
                                              ->get();
                                              
        $anggota_divisi = AnggotaDivisi::all();
        $setting = SettingWebProfile::latest()->first();
        $data = Divisi::leftJoin('sub_kategori_divisis','sub_kategori_divisis.id','divisis.sub_kategori_divisi_id')
                        ->leftJoin('kategori_divisis','kategori_divisis.id','sub_kategori_divisis.kategori_divisi_id')
                        ->leftJoin('anggota_divisis','anggota_divisis.id','divisis.anggota_divisi_id')
                        ->select('divisis.*','sub_kategori_divisis.sub_kategori_divisi','anggota_divisis.nama_anggota','anggota_divisis.foto')
                        ->get();
        // dd($data);
        if (request()->ajax())
          {
                return datatables()->of($data)
                        ->addColumn('kategori', function ($row) {
                            // return $row->nama_kategori;
                            $all = '';
                            $all .= '<span class="editSpan kategori_divisi_id">'.$row->sub_kategori_divisi.'</span>';
                            $all .= '<select class="form-control editInput kategori_divisi_id" id="select_kategori_divisi_edit"  name="kategori_divisi_id" style="display:none;">';
                            $all .= '<option selected disabled>-- Pilih Kategori --</option>';
                            $d = SubKategoriDivisi::all();
                             foreach ($d as $x) {
                                 $selected = '';
                                 if($row->sub_kategori_divisi_id == $x->id){
                                     $selected = 'selected';
                                 }
                                $all .= '<option '.$selected.' value="'.$x->id.'">'.$x->sub_kategori_divisi.'</option>';
                             }
                            $all .= '</select>';
                            $all .= '  <div class="invalid-feedback " id="select_kategori_divisi_edit'.$row->id.'-error">

                            </div>';
                            return $all;
                        })
                        ->addColumn('nama_anggota', function ($row) {
                           
                            return $row->nama_anggota;
                        })
                        ->editColumn('foto', function ($row) {
                            return '<img src="'.asset('foto_anggota_divisi').'/'.$row->foto.'" width="100" height="100">';
                        })
                        ->addColumn('isi', function ($row) {
                            $all = '';
                            $all .= '<span class="editSpan isi">'.$row->isi.'</span>';
                            $all .= ' <textarea name="isi" class="form-control editInput" rows="3" style="display:none">'.$row->isi.'</textarea>';
                            $all .= '  <div class="invalid-feedback " id="isi-error">

                            </div>';
                            return $all;
                        })
                        ->addColumn('action', function ($row) {
                            $btn = ' <button class="btn text-warning btn-sm edit_inline"><i
                                    class="fa fa-edit"></i></button>
                                    <button class="btn text-black btnSave btn-sm" style="display: none"><i
                                            class="fa fa-check"></i></button>
                                    <button class="btn text-danger editCancel btn-sm" style="display: none"><i
                                            class="fa fa-times"></i></button>
                                <button class="btn btn-danger btn-sm"  onclick="deleteData('.$row->id.')"><i
                                        class="fa fa-trash"></i></button>';

                            return $btn;
                        })
                        ->editColumn('DT_RowId', function ($row) {
                            return $row->id;
                        })
                        ->rawColumns(['nama_anggota','kategori','action','foto','isi'])
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('pages.divisi.index',compact('setting','title','data','kategori','anggota_divisi','subkategori','selectsubkategori'));
    }

    public function getData(Request $request)
    {
        $data = Divisi::leftJoin('kategori_divisis','kategori_divisis.id','divisis.kategori_divisi_id')
                        ->leftJoin('anggota_divisis','anggota_divisis.id','divisis.anggota_divisis')
                        ->where('divisis.id',$request->data)
                        ->select('divisis.*','kategori_divisis.nama_kategori','anggota_divisis.nama_anggota','anggota_divisis.foto')
                        ->get();

        return response()->json([
            'data' =>  $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAnggota(Request $request)
    {
        $data = AnggotaDivisi::where('id',$request->data)->first();
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
            'anggota_divisi_id' => 'required',
            'select_kategori_divisi' => 'required',
            'isi' => 'required',
        ],[
            'anggota_divisi_id.required' => 'Nama Anggota Divisi harus di isi !',
            'select_kategori_divisi.required' => 'Kategori Divisi harus di isi !',
            'isi.required' => 'Divisi harus di isi !',
        ]);

        $data = Divisi::create([
            'anggota_divisi_id' => $request->anggota_divisi_id,
            'sub_kategori_divisi_id' => $request->select_kategori_divisi,
            'isi' => $request->isi,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'data berhasil di tambah',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function show(Divisi $divisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function edit(Divisi $divisi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'kategori_divisi_id' => 'required',
            'isi' => 'required',
        ],[
            'kategori_divisi_id.required' => 'Kategori Divisi harus di isi !',
            'isi.required' => 'Divisi harus di isi !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{
                $data = Divisi::where('id',$request->id);
                $data->update([
                    'sub_kategori_divisi_id' => $request->kategori_divisi_id,
                    'isi' => $request->isi,
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
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $data = Divisi::findOrFail($request->ids);
        if($data->delete()){
            return response()->json([
                'status' => 200,
                'message' => 'data berhasil di hapus',
                'data' =>  $request->ids,
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'data gagal di hapus',
                'data' =>  '',
            ]);
        }
    }
}
