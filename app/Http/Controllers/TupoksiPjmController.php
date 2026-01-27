<?php

namespace App\Http\Controllers;

use App\Models\TupoksiPjm;
use App\Models\KategoriTupoksiPjm;
use App\Models\SettingWebProfile;
use Illuminate\Http\Request;
use Validator;

class TupoksiPjmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Tupoksi PJM';
        $kategori = KategoriTupoksiPjm::all();
        $setting = SettingWebProfile::latest()->first();
        $data = TupoksiPjm::leftJoin('kategori_tupoksi_pjms','kategori_tupoksi_pjms.id','tupoksi_pjms.kategori_tupoksi_id')
                        ->select('tupoksi_pjms.*','kategori_tupoksi_pjms.nama_kategori')
                        ->get();

        if (request()->ajax())
          {

                return datatables()->of($data)
                        ->addColumn('kategori_tupoksi', function ($row) {
                           $all = '';
                           $all .= '<span class="editSpan kategori_tupoksi_id">'.$row->nama_kategori.'</span>';
                           $all .= '<select class="form-control editInput kategori_tupoksi_id"  name="kategori_tupoksi_id" style="display:none;">';
                           $all .= '<option selected disabled>-- Pilih Kategori --</option>';
                           $d = KategoriTupoksiPjm::all();
                            foreach ($d as $x) {
                                $selected = '';
                                if($row->kategori_tupoksi_id == $x->id){
                                    $selected = 'selected';
                                }
                               $all .= '<option '.$selected.' value="'.$x->id.'">'.$x->nama_kategori.'</option>';
                            }
                           $all .= '</select>';
                           $all .= '  <div class="invalid-feedback " id="nama_kategori'.$row->id.'-error">

                           </div>';
                           return $all;
                        })->editColumn('isi_tupoksi', function ($row) {
                            $all = '';
                            $all .= '<span class="editSpan isi_tupoksi">'.$row->isi_tupoksi.'</span>';
                            $all .= '<input type="text" class="editInput isi_tupoksi form-control" name="isi_tupoksi"
                             value="'.$row->isi_tupoksi.'" style="display:none;">';
                            $all .= '  <div class="invalid-feedback " id="isi_tupoksi-error">

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
                        ->rawColumns(['action','kategori_tupoksi','isi_tupoksi'])
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('pages.tupoksi_pjm.index',compact('setting','title','data','kategori'));
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
            'kategori_pjm' => 'required',
            'isi_tupoksi_pjm' => 'required',
        ],[
            'kategori_pjm.required' => 'Kategori Tupoksi PJM harus di isi !',
            'isi_tupoksi_pjm.required' => 'Tupoksi PJM harus di isi !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{
            $data = TupoksiPjm::create([
                'kategori_tupoksi_id' => $request->kategori_pjm,
                'isi_tupoksi' => $request->isi_tupoksi_pjm
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'data berhasil di tambah',

            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TupoksiPjm  $tupoksiPjm
     * @return \Illuminate\Http\Response
     */
    public function show(TupoksiPjm $tupoksiPjm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TupoksiPjm  $tupoksiPjm
     * @return \Illuminate\Http\Response
     */
    public function edit(TupoksiPjm $tupoksiPjm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TupoksiPjm  $tupoksiPjm
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'kategori_tupoksi_id' => 'required',
            'isi_tupoksi' => 'required',
        ],[
            'kategori_tupoksi_id.required' => 'Kategori Tupoksi PJM harus di isi !',
            'isi_tupoksi.required' => 'Tupoksi PJM harus di isi !'
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di update',
                'data' =>  $validate->errors(),
            ]);
        }else{
            $a = KategoriTupoksiPjm::where('id',$request->kategori_tupoksi_id)->first();
            $s = [
                    'kategori_tupoksi_id' => $a->id,
                    'nama_kategori' => $a->nama_kategori,
                    'isi_tupoksi' => $request->isi_tupoksi
            ];

            $data = TupoksiPjm::findOrFail($request->id);
            $data->update([
                'kategori_tupoksi_id' => $request->kategori_tupoksi_id,
                'isi_tupoksi' => $request->isi_tupoksi
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'data berhasil di update',
                'data' =>  $s,

            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TupoksiPjm  $tupoksiPjm
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
            $data = TupoksiPjm::findOrFail($request->ids);
            $data->delete();
            return response()->json([
                'status' => 200,
                'message' => 'data berhasil di hapus',
            ]);
    }


}
