<?php

namespace App\Http\Controllers;

use App\Models\user;
use App\Models\SettingWebProfile;
use Validator;
use Auth;
use Hash;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
    }

    public function getData(Request $request)
    {
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAnggota(Request $request)
    {
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function show(Divisi $divisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'User Edit';
        $data = User::findOrFail($id);
        $setting = SettingWebProfile::latest()->first();
        return view('pages.user.edit',compact('data','title','setting'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8|different:old_password',
            'confirm_password' => 'required|string|same:new_password',
        ],[
            'name.required' => 'Nama harus di isi !',
            'old_password.required' => 'Password lama harus di isi !',
            'new_password.required' => 'Password baru harus di isi !',
            'confirm_password.required' => 'Konfirmasi Password harus di isi !',
            'new_password.different' => 'Password baru dan password lama harus berbeda !',
            'confirm_password.same' => 'Konfirmasi Password tidak sesuai dengan password baru !',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => 'user gagal di update',
                'data' =>  $validator->errors(),
            ]);
        }else{
            $id = Auth::user()->id;
            $user = User::findOrFail($id);
    
            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json([
                    'status' => 400,
                    'data' => ['old_password' => ['Password Lama yang anda input tidak sesuai']],
                ]);
            }
            $user->name = $request->name;
            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json([
                'status' => 200,
                'message' => 'user berhasil di update',
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
    }
}
