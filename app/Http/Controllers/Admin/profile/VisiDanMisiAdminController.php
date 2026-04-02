<?php

namespace App\Http\Controllers\Admin\profile;

use App\Models\VisiMisiTujuan;
use App\Http\Controllers\Controller;
use App\Models\SettingWebProfile;
use Validator;
use DataTables;
use Illuminate\Http\Request;

class VisiDanMisiAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Visi Misi Tujuan';
        $setting = SettingWebProfile::latest()->first();
        $data = VisiMisiTujuan::all();

        if (request()->ajax())
          {
                return datatables()->of($data)
                        ->addColumn('kategori', function ($row) {
                            $visi_misi = [
                                'visi' => ['visi_misi_tujuan' => 'visi'],
                                'misi' => ['visi_misi_tujuan' => 'misi'],
                                'tujuan' => ['visi_misi_tujuan' => 'tujuan'],
                            ];

                            $all = '';
                            $all .= '<span class="editSpan visi_misi_tujuan">' . $row->visi_misi_tujuan . '</span>';
                            $all .= '<select class="form-control editInput visi_misi_tujuan"  name="visi_misi_tujuan" style="display:none;">';
                            $all .= '<option selected disabled>-- Pilih visi_misi_tujuan --</option>';

                            foreach ($visi_misi as $key => $value) {
                                $selected = '';
                                if ($row->visi_misi_tujuan == $value['visi_misi_tujuan']) {
                                    $selected = 'selected';
                                }
                                $all .= '<option ' . $selected . ' value="' . $value['visi_misi_tujuan'] . '">' . $value['visi_misi_tujuan'] . '</option>';
                            }
                            $all .= '</select>';
                            $all .= '  <div class="invalid-feedback " id="visi_misi_tujuan' . $row->id . '-error"></div>';
                            return $all;
                        })
                         ->addColumn('isi', function ($row) {
                            $all = '';
                            $all .= '<span class="editSpan isi">'.$row->isi.'</span>';
                            $all .= '<input type="text" class="editInput isi form-control" name="isi"
                             value="'.$row->isi.'" style="display:none;">';
                            $all .= '  <div class="invalid-feedback " id="isi'.$row->id.'-error">

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
                        ->rawColumns(['action','kategori','isi'])
                        ->addIndexColumn()
                        ->make(true);
                    }

      return view('admin.profile.visi_dan_misi_admin',compact('setting','title','data'));
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
            'visi_misi_tujuan' => 'required',
            'isi' => 'required'
        ],[
            'visi_misi_tujuan.required' => 'Visi Misi Tujuan harus di isi!',
            'isi.required' => 'silahkan isi visi misi tujuan'
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{
                $data = VisiMisiTujuan::create([
                    'visi_misi_tujuan' => $request->visi_misi_tujuan,
                    'isi' => $request->isi
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
     * @param  \App\Models\VisiMisiTujuan  $visiMisiTujuan
     * @return \Illuminate\Http\Response
     */
    public function show(VisiMisiTujuan $visiMisiTujuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisiMisiTujuan  $visiMisiTujuan
     * @return \Illuminate\Http\Response
     */
    public function edit(VisiMisiTujuan $visiMisiTujuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisiMisiTujuan  $visiMisiTujuan
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'visi_misi_tujuan' => 'required',
        ],[
            'visi_misi_tujuan.required' => 'Visi Misi Tujuan harus di isi !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di update',
                'data' =>  $validate->errors(),
            ]);
        }else{
            $data = VisiMisiTujuan::findOrFail($request->id);
            $data->update([
                'visi_misi_tujuan' => $request->visi_misi_tujuan,
            ]);

            $isi = [
                'visi_misi_tujuan' => $request->visi_misi_tujuan,
                'isi' => $request->isi
            ];

            return response()->json([
                'status' => 200,
                'message' => 'data berhasil di update',
                'data' =>  $isi,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisiMisiTujuan  $visiMisiTujuan
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $data = VisiMisiTujuan::findOrFail($request->ids);
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
