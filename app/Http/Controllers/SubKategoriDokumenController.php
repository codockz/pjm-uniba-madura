<?php

namespace App\Http\Controllers;

use App\Models\SubKategoriDokumen;
use App\Models\Dokumen;
use App\Models\KategoriDokumen;
use App\Models\SettingWebProfile;
use Validator;

use Illuminate\Http\Request;

class SubKategoriDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Dokumen';
        
        $data = SubKategoriDokumen::leftJoin('kategori_dokumens','kategori_dokumens.id','sub_kategori_dokumens.kategori_dokumen_id')
                                  ->select('sub_kategori_dokumens.*','kategori_dokumens.nama_kategori')->get();
        $setting = SettingWebProfile::latest()->first();
        if (request()->ajax())
          {
                return datatables()->of($data)
                        ->addColumn('nama_sub_kategori', function ($row) {
                           $all = '';
                           $all .= '<span class="editSpan nama_sub_kategori">'.$row->sub_kategori_dokumen.'</span>';
                           $all .= '<input name="nama_sub_kategori" class="form-control editInput nama_sub_kategori" value="'.$row->sub_kategori_dokumen.'" style="display:none;">';
                           $all .= '<div class="invalid-feedback " id="nama_sub_kategori'.$row->id.'-error">

                           </div>';
                           return $all;
                        })
                        ->addColumn('kategori_dokumen', function ($row) {
                            $all = '';
                            $all .= '<span class="editSpan kategori_dokumen">'.$row->nama_kategori.'</span>';
                            $all .= '<select name="kategori_dokumen" class="form-control editInput kategori_dokumen" id="kategori_dokumens_id" value="'.$row->nama_kategori.'" style="display:none;">';
                            $kategori = KategoriDokumen::all();
                            foreach ($kategori as $kat) {
                                    $selected = '';
                                    if($row->kategori_dokumen_id == $kat->id){
                                        $selected = 'selected';
                                    }
                                    $all .= '<option '.$selected.' value='.$kat->id.'>'.$kat->nama_kategori.'</option>';
                                }
                            $all .= '</select>';
                            $all .= '<div class="invalid-feedback " id="nama_sub_kategori'.$row->id.'-error">
 
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
                        ->rawColumns(['action','nama_sub_kategori','kategori_dokumen'])
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
            'sub_kategori_dokumen' => 'required|unique:sub_kategori_dokumens',
            'kategori_id' => 'required',
        ],[
            'sub_kategori_dokumen.required' => ' Sub Kategori Dokumen harus di isi !',
            'sub_kategori_dokumen.unique' => 'Sub Kategori Dokumen sudah ada !',
            'kategori_id.required' => 'Kategori Dokumen harus di isi  !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{
            $data = SubKategoriDokumen::create([
                'sub_kategori_dokumen' => $request->sub_kategori_dokumen,
                'kategori_dokumen_id' => $request->kategori_id,
            ]);

            $isi = SubKategoriDokumen::leftJoin('kategori_dokumens','kategori_dokumens.id','sub_kategori_dokumens.kategori_dokumen_id')
                                     ->select('sub_kategori_dokumens.*','kategori_dokumens.nama_kategori')->get();

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
     * @param  \App\Models\SubKategoriDokumen  $SubKategoriDokumen
     * @return \Illuminate\Http\Response
     */
    public function show(SubKategoriDokumen $SubKategoriDokumen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubKategoriDokumen  $SubKategoriDokumen
     * @return \Illuminate\Http\Response
     */
    public function edit(SubKategoriDokumen $SubKategoriDokumen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubKategoriDokumen  $SubKategoriDokumen
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'nama_sub_kategori' => 'required',
            'kategori_dokumen' => 'required',
        ],[
            'nama_sub_kategori.required' => ' Sub Kategori Dokumen harus di isi !',
            'kategori_dokumen.required' => 'Kategori Dokumen harus di isi  !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di update',
                'data' =>  $validate->errors(),
            ]);
        }else{
            $data = SubKategoriDokumen::findOrFail($request->id);
            $data->update([
                'sub_kategori_dokumen' => $request->nama_sub_kategori,
                'kategori_dokumen_id' => $request->kategori_dokumen,
            ]);
            $kat = KategoriDokumen::where('id',$request->kategori_dokumen)->first();
            $isi_data = [
                'sub_kategori' => $request->nama_sub_kategori,
                'kategori_id' => $request->kategori_dokumen,
                'kategori_dokumen' => $kat->nama_kategori
            ];

        
            $isi = SubKategoriDokumen::leftJoin('kategori_dokumens','kategori_dokumens.id','sub_kategori_dokumens.kategori_dokumen_id')
                                     ->select('sub_kategori_dokumens.*','kategori_dokumens.nama_kategori')->get();
            return response()->json([
                'status' => 200,
                'message' => 'data berhasil di update',
                'data' =>  $isi_data,
                'data_select' => $isi,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubKategoriDokumen  $SubKategoriDokumen
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $data = SubKategoriDokumen::findOrFail($request->ids);

        $check = Dokumen::where('sub_kategori_dokumen_id',$data->id)->first();
        if(!is_null($check)){
            return response()->json([
                'status' => 400,
                'errors' => 'Kategori Dokumen terkait data Dokumen silahkan hapus terlebih dahulu data Dokumen !',
            ]);
        }else{
            if($data->delete()){
                $isi = SubKategoriDokumen::leftJoin('kategori_dokumens','kategori_dokumens.id','sub_kategori_dokumens.kategori_dokumen_id')
                                     ->select('sub_kategori_dokumens.*','kategori_dokumens.nama_kategori')->get();
                return response()->json([
                    'status' => 200,
                    'message' => 'data berhasil di hapus',
                    'data' =>  $isi,
                ]);
            }
        }
    }
}
