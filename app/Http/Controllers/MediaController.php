<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\KategoriMedia;
use App\Models\SettingWebProfile;
use Validator;
use Auth;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $title = 'Media PJM';
        $kategori = KategoriMedia::all();
        $setting = SettingWebProfile::latest()->first();
        $data = Media::leftJoin('kategori_media','kategori_media.id','media.kategori_media_id')
                        ->select('media.*','kategori_media.nama_kategori')
                        ->get();

        if (request()->ajax())
          {

                return datatables()->of($data)
                        ->addColumn('kategori', function ($row) {
                            return $row->nama_kategori;
                        })
                        ->addColumn('judul', function ($row) {
                            return $row->judul;
                        })
                        ->addColumn('isi', function ($row) {
                            return $row->isi;
                        })
                        ->editColumn('gambar', function ($row) {
                            return '<img src="'.asset('gambar_media').'/'.$row->gambar.'" width="100" height="100">';
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
                        ->rawColumns(['action','gambar'])
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('admin.media.index',compact('setting','title','data','kategori'));
    }


    public function getData(Request $request)
    {
        $data = Media::leftJoin('kategori_media','kategori_media.id','media.kategori_media_id')
                        ->where('media.id',$request->data)
                        ->select('media.*','kategori_media.nama_kategori')
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
            'judul' => 'required|unique:media',
            'isi' => 'required',
            'lokasi' => 'required',
            'tanggal'=> 'required',
            'jam'=> 'required',
            'kategori_media' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg,gif,svg',


        ],[
            'judul.unique' => 'Judul Sudah ada !',
            'tanggal.required' => 'Tanggal Harus di isi !',
            'lokasi.required' => 'Lokasi Harus di isi !',
            'Jam.required' => 'Jam Harus di isi !',
            'judul.required' => 'judul Personalia harus di isi !',
            'isi.required' => 'isi harus di isi !',
            'kategori_media.required' => 'Kategori Media harus di isi !',
            'gambar.required' => 'Gambar harus di isi !',
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
            $judul = $request->judul;
            $slug = strtolower($judul);
            $slug = str_replace(' ', '-', $slug);

            $file_media = $request->file('gambar');
            $media = time() . '_' . $file_media->getClientOriginalName();
            $file_media->move(public_path('gambar_media'), $media);

            $save = Media::create([
                'kategori_media_id' => $request->kategori_media,
                'judul' => $request->judul,
                'isi' => $request->isi,
                'lokasi' => $request->lokasi,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
                'user_id' => Auth::user()->id,
                'gambar' => $media,
                'slug' => $slug,

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
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {

        $validate = Validator::make($request->all(),[
            'judul_edit' => 'required',
            'isi_edit' => 'required',
            'kategori_media' => 'required',
            'lokasi_edit' => 'required',
            'tanggal_edit' => 'required',
            'jam_edit' => 'required',
            'gambar_edit' => 'image|mimes:jpg,png,jpeg,gif,svg',
        ],[
            'judul_edit.required' => 'Judul harus di isi !',
            'isi_edit.required' => 'Isi harus di isi !',
            'lokasi_edit.required' => 'Lokasi harus di isi !',
            'tanggal_edit.required' => 'Tanggal harus di isi !',
            'jam_edit.required' => 'Jam harus di isi !',
            'kategori_media.required' => 'Kategori Media harus di isi !',
            'gambar_edit.required' => 'Gambar harus di isi !',
            'gambar_edit.image' => 'Gambar harus type jpg,png,jpeg,gif,svg !',
            'gambar_edit.mimes' => 'Gambar harus type jpg,png !',
            'gambar_edit.max' => 'Gambar maksimal size 2mb !',
        ]);


    if($validate->fails()){
        return response()->json([
            'status' => 400,
            'errors' => 'data gagal di tambahkan',
            'data' =>  $validate->errors(),
        ]);
    }else{


        $file_gambar = $request->file('gambar_edit');
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
            $data = Media::where('id',$request->id);
            $data->update([
                'kategori_media_id' => $request->kategori_media,
                'judul' => $request->judul_edit,
                'isi' => $request->isi_edit,
                'lokasi' => $request->lokasi_edit,
                'tanggal' => $request->tanggal_edit,
                'jam' => $request->jam_edit,
                'gambar' => $gambar
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
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $data = Media::findOrFail($request->ids);
        if($data->delete()){
            $path = public_path('gambar_media/').$data->gambar;
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
