<?php

namespace App\Http\Controllers;

use App\Models\SettingHalamanUtama;
use App\Models\ContentFooter;
use App\Models\SettingWebProfile;
use App\Models\About;
use Validator;
use Illuminate\Http\Request;

class SettingHalamanUtamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Setting Halaman Utama';
        $setting = SettingWebProfile::latest()->first();
        $data = SettingHalamanUtama::all();
        $setting_footer = ContentFooter::first();
        $about = About::first();

        if (request()->ajax())
          {
                return datatables()->of($data)
                        ->addColumn('judul', function ($row) {
                            return $row->judul;
                        })
                        ->addColumn('isi', function ($row) {
                            return $row->isi;
                        })
                        ->editColumn('gambar_slide', function ($row) {
                            return '<img src="'.asset('gambar_slide').'/'.$row->gambar_slide.'" width="100" height="100">';
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
                        ->rawColumns(['action','gambar_slide'])
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('admin.setting_halaman_utama.index',compact('setting','title','data','setting_footer','about'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function setting_footer(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name' => 'required',
            'lokasi' => 'required',
            'g_map' => 'required',
            'facebook' => 'required',
            'instagram' => 'required',
            'youtube' => 'required',
            'no_telp' => 'required',


        ],[
            'name.required' => 'Nama Copyright harus di isi !',
            'lokasi.required' => 'Lokasi harus di isi !',
            'g_map.required' => 'Google Map harus di isi !',
            'facebook.required' => 'Facebook harus di isi !',
            'instagram.required' => 'Instagram di isi !',
            'youtube.required' => 'Youtube harus di isi !',
            'no_telp.required' => 'Gambar harus di isi !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{
            if($request->old_id){
                $data = ContentFooter::findOrFail($request->old_id);
                $data->update([
                    'name' => $request->name,
                    'lokasi' => $request->lokasi,
                    'g_map' => $request->g_map,
                    'facebook' => $request->facebook,
                    'instagram' => $request->instagram,
                    'youtube' => $request->youtube,
                    'no_telp' => $request->no_telp,
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'data berhasil di update',
                ]);
            }else{
                $save = ContentFooter::create([
                    'name' => $request->name,
                    'lokasi' => $request->lokasi,
                    'g_map' => $request->g_map,
                    'facebook' => $request->facebook,
                    'instagram' => $request->instagram,
                    'youtube' => $request->youtube,
                    'no_telp' => $request->no_telp,
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'data berhasil di tambah',
                ]);
            }


        }
    }

     public function getData(Request $request)
    {
        // dd($request->all());
        $data = SettingHalamanUtama::findOrFail($request->data);
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
            'judul_slide' => 'required',
            'isi' => 'required',
            'gambar_slide' => 'required|image|mimes:jpg,png,jpeg,gif,svg',


        ],[
            'judul_slide.required' => 'Judul Slide harus di isi !',
            'isi.required' => 'Isi harus di isi !',
            'gambar_slide.required' => 'Gambar Slide harus di isi !',
            'gambar_slide.image' => 'Gambar Slide harus type jpg,png,jpeg,gif,svg !',
            'gambar_slide.mimes' => 'Gambar Slide harus type jpg,png !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{


            $file_gambar_slide = $request->file('gambar_slide');
            $gambar_slide = time() . '_' . $file_gambar_slide->getClientOriginalName();
            $file_gambar_slide->move(public_path('gambar_slide'), $gambar_slide);

            $save = SettingHalamanUtama ::create([
                'judul' => $request->judul_slide,
                'isi' => $request->isi,
                'gambar_slide' => $gambar_slide,

            ]);

            return response()->json([
                'status' => 200,
                'message' => 'data berhasil di tambah',
            ]);
        }
    }


    public function AboutStore(Request $request)
    {
        if(is_null($request->about_id)){
            $validate = Validator::make($request->all(),[
                'link_video' => 'required',
                'isi' => 'required',

            ],[
                'link_video.required' => 'Link Video Youtube harus di isi !',
                'isi.required' => 'Isi harus di isi !',
            ]);
            if($validate->fails()){
                return response()->json([
                    'status' => 400,
                    'errors' => 'data gagal di tambahkan',
                    'data' =>  $validate->errors(),
                ]);
            }else{
                $about = About::create([
                    'isi' => $request->isi,
                    'link_video' => $request->link_video,

                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'data berhasil di tambah',
                ]);
            }
        }else{
            $about = About::findOrFail($request->about_id);
            $about->update([
                'isi' => $request->isi,
                'link_video' => $request->link_video,
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'data berhasil di update',
            ]);
        }



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SettingHalamanUtama  $settingHalamanUtama
     * @return \Illuminate\Http\Response
     */
    public function edit(SettingHalamanUtama $settingHalamanUtama)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SettingHalamanUtama  $settingHalamanUtama
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'judul_edit' => 'required',
            'isi_edit' => 'required',
            'gambar_slide' => 'image|mimes:jpg,png,jpeg,gif,svg',


        ],[
            'judul_edit.required' => 'Judul Slide harus di isi !',
            'isi_edit.required' => 'Pangkat harus di isi !',
            'gambar_slide.image' => 'Gambar Slide harus type jpg,png,jpeg,gif,svg !',
            'gambar_slide.mimes' => 'Gambar Slide harus type jpg,png !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{

            // dd($request->all());

            $file_gambar_slide = $request->file('gambar_slide');
            if(is_null($request->old_gambar_slide)){
                $gambar_slide = time() . '-' . $file_gambar_slide->getClientOriginalName();
                $file_gambar_slide->move(public_path('gambar_slide'), $gambar_slide);
            }else{
                $gambar_slide = $request->old_gambar_slide;
                if(!is_null($file_gambar_slide)){
                    $path = public_path('gambar_slide/').$request->old_gambar_slide;
                    if(unlink($path)){
                        $gambar_slide = time() . '_' . $file_gambar_slide->getClientOriginalName();
                        $file_gambar_slide->move(public_path('gambar_slide'), $gambar_slide);
                    }
                }
            }
                $data = SettingHalamanUtama::where('id',$request->id);
                $data->update([
                    'judul' => $request->judul_edit,
                    'isi' => $request->isi_edit,
                    'gambar_slide' => $gambar_slide,
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
     * @param  \App\Models\SettingHalamanUtama  $settingHalamanUtama
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $data = SettingHalamanUtama::findOrFail($request->ids);
        if($data->delete()){
            $path = public_path('gambar_slide/').$data->gambar_slide;
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
