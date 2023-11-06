<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AlatController extends Controller
{
    public function index() {
        $response = Http::get("https://rose-caterpillar-sari.cyclic.app/api/alat-iot");
        $datas = $response ->json()['data'];
        
        return view('admin/Perangkat/alat', [
            "datas" => $datas
        ]);
    }  
}
