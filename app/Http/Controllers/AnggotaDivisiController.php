<?php

namespace App\Http\Controllers;

use App\Models\AnggotaDivisi;
use App\Models\Divisi;
use App\Models\SettingWebProfile;
use Illuminate\Http\Request;
use Validator;

class AnggotaDivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Divisi';
        $setting = SettingWebProfile::latest()->first();
        $data = AnggotaDivisi::all();

        if (request()->ajax())
          {
            return datatables()->of($data)
                    ->addColumn('nama_anggota', function ($row) {
                        return $row->nama_anggota;
                    })
                    ->editColumn('foto', function ($row) {
                        return '<img src="'.asset('foto_anggota_divisi').'/'.$row->foto.'" width="100" height="100">';
                    })
                    ->addColumn('action', function ($row) {
                        $btn = '<button class="btn btn-warning btn-sm edit-button" data-toggle="modal" data-target="#editModal" data-id="'.$row->id.'"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm"  onclick="deleteDataAnggota('.$row->id.')"><i
                                    class="fa fa-trash"></i></button>';

                        return $btn;
                    })
                    ->editColumn('DT_RowId', function ($row) {
                        return $row->id;
                    })
                    ->rawColumns(['action','foto'])
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('pages.divisi.index',compact('setting','title','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
       $data = AnggotaDivisi::findOrFail($request->data);
       return response()->json($data);
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
            'nama_anggota' => 'required|unique:anggota_divisis',
            'foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',


        ],[
            'nama_anggota.required' => 'Nama Anggota Divisi harus di isi !',
            'nama_anggota.unique' => 'Nama Anggota Divisi sudah ada !',
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
            $file_foto->move(public_path('foto_anggota_divisi'), $foto);

            $data = AnggotaDivisi::create([
                'nama_anggota' => $request->nama_anggota,
                'foto' => $foto,

            ]);
            $isi = AnggotaDivisi::all();
            return response()->json([
                'status' => 200,
                'message' => 'data berhasil di tambah',
                'data' => $isi
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnggotaDivisi  $anggotaDivisi
     * @return \Illuminate\Http\Response
     */
    public function show(AnggotaDivisi $anggotaDivisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnggotaDivisi  $anggotaDivisi
     * @return \Illuminate\Http\Response
     */
    public function edit(AnggotaDivisi $anggotaDivisi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnggotaDivisi  $anggotaDivisi
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'edit_nama_anggota' => 'required',
            'edit_foto' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ],[
            'edit_nama_anggota.required' => 'Nama Anggota Divisi harus di isi !',
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
                $path = public_path('foto_petugas_divisi/').$request->old_foto;
                $file_foto->move(public_path('foto_petugas_divisi'), $foto);
            }else{
                $foto = $request->old_foto;
            }

            $data = AnggotaDivisi::findOrFail($request->id);
            $data->update([
                'nama_anggota' => $request->edit_nama_anggota,
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
     * @param  \App\Models\AnggotaDivisi  $anggotaDivisi
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $data = AnggotaDivisi::findOrFail($request->ids);
        $check = Divisi::where('anggota_divisi_id',$data->id)->first();
        if(!is_null($check)){
            return response()->json([
                'status' => 400,
                'error' => 'Anggota Divisi terkait dengan data Divisi silahkan hapus terlebih dahulu data Divisi !',

            ]);
        }else{
            $data->delete();
            $path = public_path('foto_anggota_divisi/').$data->foto;
            if($path){
                unlink($path);
            }
            $isi = AnggotaDivisi::all();
            return response()->json([
                'status' => 200,
                'message' => 'data berhasil di hapus',
                'data' =>  $isi,
            ]);
        }

    }
}
