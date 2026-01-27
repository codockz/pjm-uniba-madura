<?php

namespace App\Http\Controllers;

use App\Models\Personalia;
use App\Models\KategoriPersonalia;
use App\Models\SettingWebProfile;
use Illuminate\Http\Request;
use Validator;


class PersonaliaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Personalia';
        $kategori = KategoriPersonalia::all();
        $setting = SettingWebProfile::latest()->first();
        $data = Personalia::join('kategori_personalias','kategori_personalias.id','personalias.kategori_personalia_id')
                          ->select('personalias.*','kategori_personalias.nama_kategori')->get();
        if (request()->ajax())
          {
                return datatables()->of($data)
                ->addColumn('kategori_personalia_id', function ($row) {
                    $all = '';
                    $all .= '<span class="editSpan kategori_personalia_id">'.$row->nama_kategori.'</span>';
                    $all .= '<select class="form-control editInput kategori_personalia_id"  name="kategori_personalia_id" style="display:none;">';
                    $all .= '<option selected disabled>-- Pilih Kategori --</option>';
                    $d = KategoriPersonalia::all();
                     foreach ($d as $x) {
                         $selected = '';
                         if($row->kategori_personalia_id == $x->id){
                             $selected = 'selected';
                         }
                        $all .= '<option '.$selected.' value="'.$x->id.'">'.$x->nama_kategori.'</option>';
                     }
                    $all .= '</select>';
                    $all .= '  <div class="invalid-feedback " id="nama_kategori'.$row->id.'-error">

                    </div>';
                    return $all;
                    })
                        ->addColumn('personalia', function ($row) {
                           $all = '';
                           $all .= '<span class="editSpan personalia">'.$row->personalia.'</span>';
                           $all .= '<input type="text" class="editInput personalia form-control" name="personalia"
                            value="'.$row->personalia.'" style="display:none;">';
                           $all .= '  <div class="invalid-feedback " id="personalia'.$row->id.'-error">

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
                            // Assuming $row->id contains the ID of each row, modify it accordingly
                            return $row->id; // Set DT_RowId to the ID of the row
                        })
                        ->rawColumns(['action','personalia','kategori_personalia_id'])
                        ->addIndexColumn()
                        ->make(true);

        }

        return view('pages.personalia.index',compact('setting','title','data','kategori'));
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
            'personalia' => 'required',
            'kategori_personalia_id' => 'required',
        ],[
            'personalia.required' => 'Personalia harus di isi !',
            'kategori_personalia_id.required' => 'Kategori Personalia harus di isi !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{
            $data = Personalia::create([
                'kategori_personalia_id' => $request->kategori_personalia_id,
                'personalia' => $request->personalia,
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
     * @param  \App\Models\Personalia  $personalia
     * @return \Illuminate\Http\Response
     */
    public function show(Personalia $personalia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personalia  $personalia
     * @return \Illuminate\Http\Response
     */
    public function edit(Personalia $personalia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personalia  $personalia
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'personalia' => 'required',
            'kategori_personalia_id' => 'required',
        ],[
            'personalia.required' => 'Personalia harus di isi !',
            'kategori_personalia_id.required' => 'Kategori Personalia harus di isi !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di update',
                'data' =>  $validate->errors(),
            ]);
        }else{
            $data = Personalia::findOrFail($request->id);
            $data->update([
                'kategori_personalia_id' => $request->kategori_personalia_id,
                'personalia' => $request->personalia,
            ]);

            $nama_kategori = KategoriPersonalia::where('id',$request->kategori_personalia_id)->first();
            $isi = [
                'kategori_personalia_id' => $request->kategori_personalia_id,
                'nama_kategori' => $nama_kategori->nama_kategori,
                'personalia' => $request->personalia,
            ];
            return response()->json([
                'status' => 200,
                'message' => 'data berhasil di update',
                'data' =>  $isi,
            ]);
        }
    }


    public function delete(Request $request)
    {
        $data = Personalia::findOrFail($request->ids);
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
