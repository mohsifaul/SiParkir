<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LahanParkirController extends Controller
{
    public function index() {
        $response = Http::get("https://rose-caterpillar-sari.cyclic.app/api/lahan-parkir");
        $datas = $response ->json()['data'];
        
        return view('admin/Lahan/lahanParkir', [
            "datas" => $datas
        ]);
    }    
}
