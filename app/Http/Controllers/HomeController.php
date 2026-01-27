<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingWebProfile;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $setting = SettingWebProfile::first();
        $title = 'Home';
        return view('home',compact('title','setting'));
    }
}
