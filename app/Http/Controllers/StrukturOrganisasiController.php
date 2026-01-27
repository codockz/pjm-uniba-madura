<?php

namespace App\Http\Controllers;

use App\Models\StrukturOrganisasi;
use App\Models\KategoriStrukturOrganisasi;
use Illuminate\Http\Request;
use App\Models\SettingWebProfile;
use Validator;

class StrukturOrganisasiController extends Controller
{

    public function index()
    {
        $title = 'Struktur Organisasi';
        $kategori = KategoriStrukturOrganisasi::all();
        $setting = SettingWebProfile::latest()->first();
        $data = StrukturOrganisasi::leftJoin('kategori_struktur_organisasis','kategori_struktur_organisasis.id','struktur_organisasis.kategori_struktur_id')
                        ->select('struktur_organisasis.*','kategori_struktur_organisasis.nama_kategori')
                        ->get();

        if (request()->ajax())
          {

                return datatables()->of($data)
                        ->addColumn('kategori', function ($row) {
                            return $row->nama_kategori;
                        })
                        ->addColumn('nama_anggota', function ($row) {
                            return $row->nama_anggota;
                        })
                        ->addColumn('jabatan', function ($row) {
                            return $row->jabatan;
                        })
                        ->editColumn('foto', function ($row) {
                            return '<img src="'.asset('foto_anggota_struktur_organisasi').'/'.$row->foto.'" width="100" height="100">';
                        })
                        ->addColumn('action', function ($row) {
                            $btn = '<button type="button" class="btn text-warning edit-button" data-toggle="modal" data-target="#editModal" data-row-id="'.$row->id.'">
                            <i class="fas fa-edit"></i>
                            </button>
                                <button class="btn btn-danger btn-sm"  onclick="deleteData('.$row->id.')"><i
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
        return view('pages.struktur_organisasi.index',compact('setting','title','data','kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $data = StrukturOrganisasi::leftJoin('kategori_struktur_organisasis','kategori_struktur_organisasis.id','struktur_organisasis.kategori_struktur_id')
                        ->where('struktur_organisasis.id',$request->data)
                        ->select('struktur_organisasis.*','kategori_struktur_organisasis.nama_kategori')
                        ->first();

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
            'nama_anggota' => 'required',
            'jabatan' => 'required',
            'kategori_struktur' => 'required',
            'foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',


        ],[
            'nama_anggota.required' => 'Nama Anggota Personalia harus di isi !',
            'jabatan.required' => 'Pangkat harus di isi !',
            'kategori_struktur.required' => 'Kategori Struktur Organisasi harus di isi !',
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
            $file_foto->move(public_path('foto_anggota_struktur_organisasi'), $foto);

            $save = StrukturOrganisasi::create([
                'kategori_struktur_id' => $request->kategori_struktur,
                'nama_anggota' => $request->nama_anggota,
                'jabatan' => $request->jabatan,
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
     * @param  \App\Models\StrukturOrganisasi  $strukturOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function show(StrukturOrganisasi $strukturOrganisasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrukturOrganisasi  $strukturOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function edit(StrukturOrganisasi $strukturOrganisasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrukturOrganisasi  $strukturOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {

            $validate = Validator::make($request->all(),[
                'kategori_struktur' => 'required',
                'nama_anggota' => 'required',
                'jabatan' => 'required',
                'foto' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'old_foto' => 'nullable',
                'id_struktur' => 'nullable',
            ],[
                'kategori_struktur.required' => 'Kategori Struktur Organisasi harus di isi !',
                'nama_anggota' => 'Nama Anggota harus di isi !',
                'jabatan' => 'Jabatan harus di isi !',
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
            if(is_null($request->old_foto)){
                $foto = time() . '-' . $file_foto->getClientOriginalName();
                $file_foto->move(public_path('foto_anggota_struktur_organisasi'), $foto);
            }else{
                $foto = $request->old_foto;
                if(!is_null($file_foto)){
                    $path = public_path('foto_anggota_struktur_organisasi/').$request->old_foto;
                    if(unlink($path)){
                        $foto = time() . '_' . $file_foto->getClientOriginalName();
                        $file_foto->move(public_path('foto_anggota_struktur_organisasi'), $foto);
                    }
                }
            }
                $data = StrukturOrganisasi::where('id',$request->id);
                $data->update([
                    'kategori_struktur_id' => $request->kategori_struktur,
                    'nama_anggota' => $request->nama_anggota,
                    'jabatan' => $request->jabatan,
                    'foto' => $foto
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
     * @param  \App\Models\StrukturOrganisasi  $strukturOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $data = StrukturOrganisasi::findOrFail($request->ids);
        if($data->delete()){
            $path = public_path('foto_anggota_struktur_organisasi/').$data->foto;
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
