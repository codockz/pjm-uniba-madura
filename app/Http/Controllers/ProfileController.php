<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\SettingWebProfile;
use Validator;
use DataTables;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $title = 'Profile';
        $setting = SettingWebProfile::latest()->first();
        $data = Profile::all();
        if (request()->ajax())
          {
                return datatables()->of($data)
                        ->addColumn('profile', function ($row) {
                           $all = '';
                           $all .= '<span class="editSpan profile">'.$row->profile.'</span>';
                           $all .= '<input type="text" class="editInput profile form-control" name="profile"
                            value="'.$row->profile.'" style="display:none;">';
                           $all .= '  <div class="invalid-feedback " id="profile'.$row->id.'-error">

                           </div>';
                           return $all;
                        })->addColumn('nama_kategori', function ($row) {
                            $all = '';
                            $all .= '<span class="editSpan nama_kategori">'.$row->nama_kategori.'</span>';
                            $all .= '<input type="text" class="editInput nama_kategori form-control" name="nama_kategori"
                             value="'.$row->nama_kategori.'" style="display:none;">';
                            $all .= '  <div class="invalid-feedback " id="nama_kategori'.$row->id.'-error">

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
                        ->rawColumns(['action','profile'])
                        ->addIndexColumn()
                        ->make(true);

        }

        return view('pages.profile.index',compact('setting','title','data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'profile' => 'required',
        ],[
            'profile.required' => 'Profile harus di isi !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{
            $data = Profile::create([
                'profile' => $request->profile,
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
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'profile' => 'required',
        ],[
            'profile.required' => 'Profile harus di isi !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di update',
                'data' =>  $validate->errors(),
            ]);
        }else{
            $data = Profile::findOrFail($request->id);
            $data->update([
                'profile' => $request->profile,
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'data berhasil di update',
                'data' =>  $request->profile,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $data = Profile::findOrFail($request->ids);
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
