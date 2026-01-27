<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\KategoriDokumen;
use App\Models\SubKategoriDokumen;
use App\Models\SettingWebProfile;
use Validator;
use Illuminate\Http\Request;
use DB;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Dokumen';
        $kategori = KategoriDokumen::all();
      
        $subkategori = DB::table('sub_kategori_dokumens')
                        ->leftJoin('kategori_dokumens', 'kategori_dokumens.id', '=', 'sub_kategori_dokumens.kategori_dokumen_id')                
                        ->select('sub_kategori_dokumens.id', 'sub_kategori_dokumens.sub_kategori_dokumen', 'kategori_dokumens.nama_kategori')
                        ->get();

        $subkategori1 =  DB::table('sub_kategori_dokumens')
                            ->leftJoin('kategori_dokumens', 'kategori_dokumens.id', '=', 'sub_kategori_dokumens.kategori_dokumen_id')                
                            ->select('sub_kategori_dokumens.id', 'sub_kategori_dokumens.sub_kategori_dokumen', 'kategori_dokumens.nama_kategori')->get();
    
        $setting = SettingWebProfile::latest()->first();
        $data = Dokumen::leftJoin('sub_kategori_dokumens','sub_kategori_dokumens.id','dokumens.sub_kategori_dokumen_id')
                        ->select('dokumens.*','sub_kategori_dokumens.sub_kategori_dokumen')
                        ->get();
                      
                        if (request()->ajax()) {
                            return datatables()->of($data)
                                ->addColumn('kategori', function ($row) {
                                    return $row->sub_kategori_dokumen;
                                })
                                ->editColumn('thumbnail', function ($row) {
                                    return '<img src="'.asset('thumbnail_dokumen').'/'.$row->thumbnail.'" width="100" height="100">';
                                })
                                ->addColumn('nama_dokumen', function ($row) {
                                    return $row->nama_dokumen;
                                })
                                ->addColumn('publish_dokumen', function ($row) {
                                    $switch = '<div class="custom-control custom-switch">';
                                    $switch .= '<input type="checkbox" class="custom-control-input" id="customSwitchPublish'.$row->id.'"';
                                    $switch .= $row->publish_dokumen == 1 ? ' checked' : '';
                                    $switch .= ' onchange="handleSwitchChange('.$row->id.')">';
                                    $switch .= '<label class="custom-control-label" for="customSwitchPublish'.$row->id.'"></label>';
                                    $switch .= '</div>';
                                    return $switch;
                                    
                                })
                                ->addColumn('download_dokumen', function ($row) {
                                    $switch = '<div class="custom-control custom-switch">';
                                    $switch .= '<input type="checkbox" class="custom-control-input" id="customSwitchDownload'.$row->id.'"';
                                    $switch .= $row->download_dokumen == 1 ? ' checked' : '';
                                    $switch .= ' onchange="UpdateSwitchDownload('.$row->id.')">';
                                    $switch .= '<label class="custom-control-label" for="customSwitchDownload'.$row->id.'"></label>';
                                    $switch .= '</div>';
                                    return $switch;
                                    
                                })
                                
                                ->addColumn('action', function ($row) {
                                    $btn = '<button type="button" class="btn btn-sm mr-2 text-warning edit-button" data-toggle="modal" data-target="#editModal" data-row-id="'.$row->id.'">
                                        <i class="fas fa-edit"></i>
                                        </button>';
                                    $btn .= '<button class="btn btn-danger btn-sm" onclick="deleteData('.$row->id.')"><i class="fa fa-trash"></i></button>';
                                    return $btn;
                                })
                                ->editColumn('DT_RowId', function ($row) {
                                    return $row->id;
                                })
                                ->rawColumns(['kategori', 'action', 'thumbnail', 'nama_dokumen', 'publish_dokumen', 'download_dokumen'])
                                ->addIndexColumn()
                                ->make(true);
                        }
                        
                                    
                            
        return view('pages.dokumen.index',compact('setting','title','data','kategori','subkategori','subkategori1'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $data = Dokumen::leftJoin('sub_kategori_dokumens','sub_kategori_dokumens.id','dokumens.sub_kategori_dokumen_id')
                                    ->where('dokumens.id',$request->data)
                                    ->select('dokumens.*','sub_kategori_dokumens.sub_kategori_dokumen')
                                    ->first();

        return response()->json([
        'data' =>  $data,
        ]);
    }
    public function publish(Request $request)
    {
        $data = Dokumen::findOrFail($request->id);
        $data->update([
            'publish_dokumen' => $request->check,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Status Publish berhasil di update !',
        ]);
    }
    public function download(Request $request)
    {
        $data = Dokumen::findOrFail($request->id);
        $data->update([
            'download_dokumen' => $request->check,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Status Download berhasil di update !',
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
            'select_kategori_dokumen' => 'required',
            'nama_dokumen' => 'required',
            'dokumen' => 'required|mimes:pdf',
            'thumbnail' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'


        ],[
            'nama_dokumen.required' => 'Nama Anggota Personalia harus di isi !',
            'select_kategori_dokumen.required' => 'Kategori Struktur Organisasi harus di isi !',
            'dokumen.required' => 'Dokumen harus di isi !',
            'dokumen.mimes' => 'Dokumen harus type PDF !',
            'thumbnail.required' => 'Thumbnail Harus di isi !',
            'thumbnail.image' => 'Thumbnail harus type jpg,png,jpeg !',
            'thumbnail.mimes' => 'Thumbnail harus type jpg,png !',
            'thumbnail.max' => 'Thumbnail maksimal size 2mb !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{

            $file_dokumen = $request->file('dokumen');
            $dokumen = time() . '_' . $file_dokumen->getClientOriginalName();
            $file_dokumen->move(public_path('file_dokumen'), $dokumen);

            $file_thumbnail = $request->file('thumbnail');
            $thumbnail = time() . '_' . $file_thumbnail->getClientOriginalName();
            $file_thumbnail->move(public_path('thumbnail_dokumen'), $thumbnail);

            $save = Dokumen::create([
                'sub_kategori_dokumen_id' => $request->select_kategori_dokumen,
                'nama_dokumen' => $request->nama_dokumen,
                'dokumen' => $dokumen,
                'thumbnail' => $thumbnail,
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
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function show(Dokumen $dokumen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function edit(Dokumen $dokumen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'sub_kategori_dokumen_id' => 'required',
            'nama_dokumen' => 'required',
            'dokumen' => 'mimes:pdf',
            'thumbnail' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'


        ],[
            'nama_dokumen.required' => 'Nama DOkumen harus di isi !',
            'sub_kategori_dokumen_id.required' => 'Sub Kategori Dokumen  harus di isi !',
            'dokumen.mimes' => 'Dokumen harus type PDF !',
            'thumbnail.image' => 'Thumbnail harus type jpg,png,jpeg !',
            'thumbnail.mimes' => 'Thumbnail harus type jpg,png !',
            'thumbnail.max' => 'Thumbnail maksimal size 2mb !',
        ]);
        $file_thumbnail = $request->file('thumbnail');
        if(is_null($request->old_thumbnail)){
            $thumbnail = time() . '-' . $file_thumbnail->getClientOriginalName();
            $file_thumbnail->move(public_path('thumbnail_dokumen'), $thumbnail);
        }else{
            $thumbnail = $request->old_thumbnail;
            if(!is_null($file_thumbnail)){
                $path = public_path('thumbnail_dokumen/').$request->old_thumbnail;
                if(unlink($path)){
                    $thumbnail = time() . '_' . $file_thumbnail->getClientOriginalName();
                    $file_thumbnail->move(public_path('thumbnail_dokumen'), $thumbnail);
                }
            }
        }

        $file_dokumen = $request->file('dokumen');
        if(is_null($request->old_dokumen)){
            $dokumen = time() . '-' . $file_dokumen->getClientOriginalName();
            $file_dokumen->move(public_path('file_dokumen'), $dokumen);
        }else{
            $dokumen = $request->old_dokumen;
            if(!is_null($file_dokumen)){
                $path = public_path('file_dokumen/').$request->old_dokumen;
                if(unlink($path)){
                    $dokumen = time() . '-' . $file_dokumen->getClientOriginalName();
                    $file_dokumen->move(public_path('file_dokumen'), $dokumen);
                }
            }
        }

        $data = Dokumen::findOrFail($request->id);
        $data->update([
            'sub_kategori_dokumen_id' => $request->sub_kategori_dokumen_id,
            'nama_dokumen' => $request->nama_dokumen,
            'dokumen' => $dokumen,
            'thumbnail' => $thumbnail,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'data berhasil di update',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $data = Dokumen::findOrFail($request->ids);
        if($data->delete()){
            $path = public_path('thumbnail_dokumen/').$data->thumbnail;
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
