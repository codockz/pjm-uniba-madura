<?php

namespace App\Http\Controllers;
use App\Models\SubKategoriDokumen;
use App\Models\KategoriDokumen;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $kategori;
    protected $sub_kategori;
    public function __construct()
    {
        $this->kategori = KategoriDokumen::all();
        $this->sub_kategori = SubKategoriDokumen::all();
    }
}
