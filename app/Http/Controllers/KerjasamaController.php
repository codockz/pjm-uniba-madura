<?php

namespace App\Http\Controllers;

use App\Models\Kerjasama;
use App\Models\SettingWebProfile;
use Illuminate\Http\Request;
use Validator;

class KerjasamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Kerjasama';
        $setting = SettingWebProfile::latest()->first();
        $data = Kerjasama::all();

        if (request()->ajax())
          {
            return datatables()->of($data)
                    ->addColumn('nama', function ($row) {
                        return $row->nama;
                    })
                    ->editColumn('gambar', function ($row) {
                        return '<img src="'.asset('gambar_kerjasama').'/'.$row->gambar.'" width="100" height="100">';
                    })
                    ->addColumn('action', function ($row) {
                        $btn = '<button class="btn btn-warning btn-sm edit_inline" data-toggle="modal" data-target="#editModal" data-id="'.$row->id.'"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm"  onclick="deleteData('.$row->id.')"><i
                                    class="fa fa-trash"></i></button>';

                        return $btn;
                    })
                    ->editColumn('DT_RowId', function ($row) {
                        return $row->id;
                    })
                    ->rawColumns(['action','gambar'])
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('admin.kerjasama.index',compact('setting','title','data'));
    }


    public function getData(Request $request)
    {
        $data = Kerjasama::findOrFail($request->data);

        return response()->json([
            'data' =>  $data,
        ]);
    }

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
            'nama' => 'required|unique:kerjasama',
            'gambar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',


        ],[
            'nama.required' => 'Nama harus di isi !',
            'nama.unique' => 'Nama sudah ada !',
            'gambar.required' => 'gambar harus di isi !',
            'gambar.image' => 'gambar harus type jpg,png,jpeg,gif,svg !',
            'gambar.mimes' => 'gambar harus type jpg,png !',
            'gambar.max' => 'gambar maksimal size 2mb !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{


            $file_gambar = $request->file('gambar');
            $gambar = time() . '_' . $file_gambar->getClientOriginalName();
            $file_gambar->move(public_path('gambar_kerjasama'), $gambar);

            $data = Kerjasama::create([
                'nama' => $request->nama,
                'gambar' => $gambar,

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
            'nama' => 'required',
            'gambar' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'old_gambar' => 'nullable',
            'id' => 'nullable',
        ],[
            'nama.required' => 'Nama harus di isi harus di isi !',
            'gambar.image' => 'Gambar harus type jpg,png,jpeg,gif,svg !',
            'gambar.mimes' => 'Gambar harus type jpg,png !',
            'gambar.max' => 'Gambar maksimal size 2mb !',
        ]);


    if($validate->fails()){
        return response()->json([
            'status' => 400,
            'errors' => 'data gagal di tambahkan',
            'data' =>  $validate->errors(),
        ]);
    }else{


        $file_gambar = $request->file('gambar');
        if(is_null($request->old_gambar)){
            $gambar = time() . '-' . $file_gambar->getClientOriginalName();
            $file_gambar->move(public_path('gambar_media'), $gambar);
        }else{
            $gambar = $request->old_gambar;
            if(!is_null($file_gambar)){
                $path = public_path('gambar_media/').$request->old_gambar;
                if(unlink($path)){
                    $gambar = time() . '_' . $file_gambar->getClientOriginalName();
                    $file_gambar->move(public_path('gambar_media'), $gambar);
                }
            }
        }
            $data = Kerjasama::where('id',$request->id);
            $data->update([
                'nama' => $request->nama,
                'gambar' => $gambar,
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
     * @param  \App\Models\Kerjasama  $Kerjasama
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
            $data = Kerjasama::findOrFail($request->ids);

            $data->delete();
            $path = public_path('gambar_media/').$data->gambar;
            if($path){
                unlink($path);
            }

            return response()->json([
                'status' => 200,
                'message' => 'data berhasil di hapus',
                'data' =>  $isi,
            ]);

    }
}
