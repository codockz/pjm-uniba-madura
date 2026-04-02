<?php

namespace App\Http\Controllers;

use App\Models\SettingWebProfile;
use Illuminate\Http\Request;
use Validator;
class SettingWebProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = SettingWebProfile::latest()->first();
        $title  = 'Setting Web';

        return view('admin.setting_web.index',compact('setting','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFooterData()
    {
        $data = SettingWebProfile::first();
        return response()->json(['version' => $data]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->id_setting != ''){
            $validate = Validator::make($request->all(),[
                'nama_web' => 'required',
                'version' => 'required',
                'logo_web' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'logo_sidebar' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'old_gambar' => 'nullable',
                'old_logo' => 'nullable',
                'id_setting' => 'nullable',

            ],[
                'nama_web.required' => 'Nama Website harus di isi !',
                'version' => 'Title pertama harus di isi !',

                'logo_web.image' => 'Logo Website harus type jpg,png,jpeg,gif,svg !',
                'logo_web.mimes' => 'Logo Website harus type jpg,png !',
                'logo_web.max' => 'Logo Website maksimal size 2mb !',

                'logo_sidebar.image' => 'Logo Sidebar harus type jpg,png,jpeg,gif,svg !',
                'logo_sidebar.mimes' => 'Logo Sidebar harus type jpg,png !',
                'logo_sidebar.max' => 'Logo Sidebar maksimal size 2mb !',
            ]);
        }else{
            $validate = Validator::make($request->all(),[
                'nama_web' => 'required',
                'version' => 'required',
                'logo_web' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'logo_sidebar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'old_gambar' => 'nullable',
                'old_logo' => 'nullable',
                'id_setting' => 'nullable',

            ],[
                'nama_web.required' => 'Nama Website harus di isi !',
                'version' => 'Title pertama harus di isi !',

                'logo_web.required' => 'Logo Website harus di isi !',
                'logo_web.image' => 'Logo Website harus type jpg,png,jpeg,gif,svg !',
                'logo_web.mimes' => 'Logo Website harus type jpg,png !',
                'logo_web.max' => 'Logo Website maksimal size 2mb !',

                'logo_sidebar.required' => 'Logo Sidebar harus di isi !',
                'logo_sidebar.image' => 'Logo Sidebar harus type jpg,png,jpeg,gif,svg !',
                'logo_sidebar.mimes' => 'Logo Sidebar harus type jpg,png !',
                'logo_sidebar.max' => 'Logo Sidebar maksimal size 2mb !',
            ]);
        }

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{


            $file_logo_web = $request->file('logo_web');
            $file_logo_sidebar = $request->file('logo_sidebar');

            if(is_null($request->old_logo)){
                $logo_web = time() . '_' . $file_logo_web->getClientOriginalName();
                $file_logo_web->move(public_path('logo'), $logo_web);
            }else{
                $logo_web = $request->old_logo;
                if(!is_null($file_logo_web)){
                    $path = public_path('logo/').$request->old_logo;
                    if(unlink($path)){
                        $logo_web = time() . '_' . $file_logo_web->getClientOriginalName();
                        $file_logo_web->move(public_path('logo'), $logo_web);
                    }
                }
            }

            if(is_null($request->old_logo_sidebar)){
                $logo_sidebar = time() . '-' . $file_logo_sidebar->getClientOriginalName();
                $file_logo_sidebar->move(public_path('logo'), $logo_sidebar);
            }else{
                $logo_sidebar = $request->old_logo_sidebar;
                if(!is_null($file_logo_sidebar)){
                    $path1 = public_path('logo/').$request->old_logo_sidebar;
                    if(unlink($path1)){
                        $logo_sidebar = time() . '_' . $file_logo_sidebar->getClientOriginalName();
                        $file_logo_sidebar->move(public_path('logo'), $logo_sidebar);
                    }
                }
            }

              $data = SettingWebProfile::where('id',$request->id_setting);
              if(is_null($data->first())){
                    $save = SettingWebProfile::create([
                        'nama_web' => $request->nama_web,
                        'version' => $request->version,
                        'logo_web' => $logo_web,
                        'logo_sidebar' => $logo_sidebar
                    ]);

                    return response()->json([
                        'status' => 200,
                        'message' => 'data berhasil di tambah',
                    ]);
              }else{
                    $data->update([
                        'nama_web' => $request->nama_web,
                        'version' => $request->version,
                        'logo_web' => $logo_web,
                        'logo_sidebar' => $logo_sidebar
                    ]);
                    $content = SettingWebProfile::first();
                    return response()->json([
                        'status' => 200,
                        'message' => 'data berhasil di update',
                        'data' => $content

                    ]);
              }
        }

    }


    public function show(SettingWebProfile $settingWebProfile)
    {

    }


    public function edit(SettingWebProfile $settingWebProfile)
    {
        //
    }


    public function update(Request $request, SettingWebProfile $settingWebProfile)
    {
        //
    }


    public function destroy(SettingWebProfile $settingWebProfile)
    {
        //
    }
}
