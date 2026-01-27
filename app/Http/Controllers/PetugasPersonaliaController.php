<?php

namespace App\Http\Controllers;

use App\Models\PetugasPersonalia;
use App\Models\SettingWebProfile;
use Validator;
use Illuminate\Http\Request;

class PetugasPersonaliaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Profile';
        $setting = SettingWebProfile::latest()->first();
        $data = PetugasPersonalia::all();

        if (request()->ajax())
          {
                return datatables()->of($data)
                        ->addColumn('nama_anggota_personalia', function ($row) {
                           return $row->nama_anggota_personalia;
                        })
                        ->addColumn('pangkat', function ($row) {
                            return $row->pangkat;
                         })
                         ->addColumn('jurusan', function ($row) {
                            return $row->jurusan;
                         })
                         ->addColumn('email', function ($row) {
                            return $row->email;
                         })
                         ->addColumn('foto', function ($row) {
                            return '<img src="'.asset('foto_petugas_personalia').'/'.$row->foto.'" width="100" height="100">';
                         })
                         ->addColumn('action', function ($row) {
                            $btn = '<button class="btn btn-warning btn-sm edit_inline" data-toggle="modal" data-target="#editModal" data-id="'.$row->id.'"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteDataAnggota('.$row->id.')"><i class="fa fa-trash"></i></button>';

                            return $btn;
                        })
                        ->editColumn('DT_RowId', function ($row) {
                            // Assuming $row->id contains the ID of each row, modify it accordingly
                            return $row->id; // Set DT_RowId to the ID of the row
                        })
                        ->rawColumns(['action','foto'])
                        ->addIndexColumn()
                        ->make(true);

        }
        return view('pages.personalia.index',compact('setting','title','data'));
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
            'nama_anggota_personalia' => 'required',
            'pangkat' => 'required',
            'jurusan' => 'required',
            'email' => 'required',
            'foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',


        ],[
            'nama_anggota_personalia.required' => 'Nama Anggota Personalia harus di isi !',
            'pangkat.required' => 'Pangkat harus di isi !',
            'jurusan.required' => 'Pangkat harus di isi !',
            'email.required' => 'Pangkat harus di isi !',
            'foto.required' => 'Foto harus di isi !',
            'foto.image' => 'Foto harus type jpg,png,jpeg,gif,svg !',
            'foto.mimes' => 'Foto harus type jpg,png !',
            'foto.max' => 'Foto maksimal size 2mb !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{


            $file_foto = $request->file('foto');
            $foto = time() . '_' . $file_foto->getClientOriginalName();
            $file_foto->move(public_path('foto_petugas_personalia'), $foto);

            $save = PetugasPersonalia::create([
                'nama_anggota_personalia' => $request->nama_anggota_personalia,
                'pangkat' => $request->pangkat,
                'jurusan' => $request->jurusan,
                'email' => $request->email,
                'foto' => $foto,

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
     * @param  \App\Models\PetugasPersonalia  $petugasPersonalia
     * @return \Illuminate\Http\Response
     */
    public function show(PetugasPersonalia $petugasPersonalia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PetugasPersonalia  $petugasPersonalia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = PetugasPersonalia::findOrFail($id);

        return response()->json(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PetugasPersonalia  $petugasPersonalia
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'edit_nama_anggota_personalia' => 'required',
            'edit_pangkat' => 'required',
            'edit_jurusan' => 'required',
            'edit_email' => 'required',
            'edit_foto' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ],[
            'edit_nama_anggota_personalia.required' => 'Nama Anggota Personalia harus di isi !',
            'edit_pangkat.required' => 'Pangkat harus di isi !',
            'edit_jurusan.required' => 'Jurusan harus di isi !',
            'edit_email.required' => 'Email harus di isi !',
            'edit_foto.image' => 'Foto harus type jpg,png,jpeg,gif,svg !',
            'edit_foto.mimes' => 'Foto harus type jpg,png !',
            'edit_foto.max' => 'Foto maksimal size 2mb !',
        ]);


        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{

            $file_foto = $request->file('edit_foto');

            if(!empty($file_foto)){
                $foto = time() . '_' . $file_foto->getClientOriginalName();
                $path = public_path('foto_petugas_personalia/').$request->old_foto;
                $file_foto->move(public_path('foto_petugas_personalia'), $foto);
            }else{
                $foto = $request->old_foto;
            }

            $data = PetugasPersonalia::findOrFail($request->id);
            $data->update([
                'nama_anggota_personalia' => $request->edit_nama_anggota_personalia,
                'pangkat' => $request->edit_pangkat,
                'jurusan' => $request->edit_jurusan,
                'email' => $request->edit_email,
                'foto' => $foto,
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
     * @param  \App\Models\PetugasPersonalia  $petugasPersonalia
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $data = PetugasPersonalia::findOrFail($request->ids);
        if($data->delete()){
            $path = public_path('foto_petugas_personalia/').$data->foto;
            if($path){
                unlink($path);
            }
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
