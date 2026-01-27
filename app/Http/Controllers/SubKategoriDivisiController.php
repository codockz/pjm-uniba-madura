<?php

namespace App\Http\Controllers;

use App\Models\SubKategoriDivisi;
use App\Models\Divisi;
use App\Models\KategoriDivisi;
use App\Models\SettingWebProfile;
use Validator;

use Illuminate\Http\Request;

class SubKategoriDivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index()
    {
        $title = 'Divisi';
        
        $data = SubKategoriDivisi::leftJoin('kategori_divisis','kategori_divisis.id','sub_kategori_divisis.kategori_divisi_id')
                                  ->select('sub_kategori_divisis.*','kategori_divisis.nama_kategori')->get();
        $setting = SettingWebProfile::latest()->first();
        if (request()->ajax())
          {
                return datatables()->of($data)
                        ->addColumn('kategori_divisi', function ($row) {
                            $all = '';
                            $all .= '<span class="editSpan kategori_divisi_edit">'.$row->nama_kategori.'</span>';
                            $all .= '<select name="kategori_divisi_edit" class="form-control editInput kategori_divisi_edit" id="kategori_divisi_edit" value="'.$row->nama_kategori.'" style="display:none;">';
                            $kategori = KategoriDivisi::all();
                            foreach ($kategori as $kat) {
                                    $selected = '';
                                    if($row->kategori_divisi_id == $kat->id){
                                        $selected = 'selected';
                                    }
                                    $all .= '<option '.$selected.' value='.$kat->id.'>'.$kat->nama_kategori.'</option>';
                                }
                            $all .= '</select>';
                            $all .= '<div class="invalid-feedback " id="nama_sub_kategori'.$row->id.'-error">

                            </div>';
                            return $all;
                        })
                        ->addColumn('nama_sub_kategori', function ($row) {
                           $all = '';
                           $all .= '<span class="editSpan sub_kategori_divisi_edit">'.$row->sub_kategori_divisi.'</span>';
                           $all .= '<input name="sub_kategori_divisi_edit" class="form-control editInput sub_kategori_divisi_edit" value="'.$row->sub_kategori_divisi.'" style="display:none;">';
                           $all .= '<div class="invalid-feedback " id="sub_kategori_divisi_edit'.$row->id.'-error">

                           </div>';
                           return $all;
                        })
                        
                        ->addColumn('action', function ($row) {
                            $btn = ' <button class="btn text-warning btn-sm edit_sub_kategori"><i
                                        class="fa fa-edit"></i></button>
                                <button class="btn text-black btnSaveKategori btn-sm" style="display: none"><i
                                        class="fa fa-check"></i></button>
                                <button class="btn text-danger editCancelKategori btn-sm" style="display: none"><i
                                        class="fa fa-times"></i></button>
                                <button class="btn btn-danger btn-sm" onclick="deleteDataSubKategori('.$row->id.')"><i
                                        class="fa fa-trash"></i></button>';

                            return $btn;
                        })
                        ->editColumn('DT_RowId', function ($row) {
                            return $row->id;
                        })
                        ->rawColumns(['action','kategori_divisi','nama_sub_kategori'])
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
        // dd($request->all());
        $validate = Validator::make($request->all(),[
            'sub_kategori_divisi' => 'required|unique:sub_kategori_divisis',
            'add_select_kategori_divisi' => 'required',
        ],[
            'sub_kategori_divisi.required' => ' Sub Kategori divisi harus di isi !',
            'sub_kategori_divisi.unique' => 'Sub Kategori divisi sudah ada !',
            'add_select_kategori_divisi.required' => 'Kategori divisi harus di isi  !',
        ]);
        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{
            $data = SubKategoriDivisi::create([
                'sub_kategori_divisi' => $request->sub_kategori_divisi,
                'kategori_divisi_id' => $request->add_select_kategori_divisi,
            ]);

            $isi = SubKategoriDivisi::leftJoin('kategori_divisis','kategori_divisis.id','sub_kategori_divisis.kategori_divisi_id')
                                     ->select('sub_kategori_divisis.*','kategori_divisis.nama_kategori')->get();

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
     * @param  \App\Models\SubKategoriDivisi  $SubKategoriDivisi
     * @return \Illuminate\Http\Response
     */
    public function show(SubKategoriDivisi $SubKategoriDivisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubKategoriDivisi  $SubKategoriDivisi
     * @return \Illuminate\Http\Response
     */
    public function edit(SubKategoriDivisi $SubKategoriDivisi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubKategoriDivisi  $SubKategoriDivisi
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'sub_kategori_divisi_edit' => 'required',
            'kategori_divisi_edit' => 'required',
        ],[
            'sub_kategori_divisi_edit.required' => ' Sub Kategori divisi harus di isi !',
            'kategori_divisi_edit.required' => 'Kategori divisi harus di isi  !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di update',
                'data' =>  $validate->errors(),
            ]);
        }else{
            $data = SubKategoriDivisi::findOrFail($request->id);
            $data->update([
                'sub_kategori_divisi' => $request->sub_kategori_divisi_edit,
                'kategori_divisi_id' => $request->kategori_divisi_edit,
            ]);
            $kat = KategoriDivisi::where('id',$request->kategori_divisi_edit)->first();
            $isi_data = [
                'sub_kategori_divisi' => $request->sub_kategori_divisi_edit,
                'kategori_id' => $request->kategori_divisi_edit,
                'kategori_divisi' => $kat->nama_kategori
            ];

        
            $isi = SubKategoriDivisi::leftJoin('kategori_divisis','kategori_divisis.id','sub_kategori_divisis.kategori_divisi_id')
                                     ->select('sub_kategori_divisis.*','kategori_divisis.nama_kategori')->get();
            return response()->json([
                'status' => 200,
                'message' => 'data berhasil di update',
                'data' =>  $isi_data,
                'data_select' => $isi,
            ]);
        }
    }

   
    public function delete(Request $request)
    {
        $data = SubKategoriDivisi::findOrFail($request->ids);

        $check = divisi::where('sub_kategori_divisi_id',$data->id)->first();
        if(!is_null($check)){
            return response()->json([
                'status' => 400,
                'errors' => 'Kategori divisi terkait data divisi silahkan hapus terlebih dahulu data divisi !',
            ]);
        }else{
            if($data->delete()){
                $isi = SubKategoridivisi::leftJoin('kategori_divisis','kategori_divisis.id','sub_kategori_divisis.kategori_divisi_id')
                                     ->select('sub_kategori_divisis.*','kategori_divisis.nama_kategori')->get();
                return response()->json([
                    'status' => 200,
                    'message' => 'data berhasil di hapus',
                    'data' =>  $isi,
                ]);
            }
        }
    }
}
