<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class lahanController extends Controller
{
    public function store(Request $request)
    {
        return response()->json("Ini Berhasil");
    }
}
