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

    public function formTambah(){
        return view('admin/Lahan/tambahLahan'); // Atur nilai default jika gagal
    }

    public function formEdit($id)
    {
        $response = Http::get("https://rose-caterpillar-sari.cyclic.app/api/lahan-parkir");
        $datas = $response->json()['data'];

        // Cari data dengan ID yang sesuai
        $dataLahan = null;
        foreach ($datas as $data) {
            if ($data['id'] === $id) {
                $dataLahan = $data;
                break;
            }
        }

        if ($dataLahan === null) {
            return redirect('/lahan-parkir')->with('error', 'Data tidak ditemukan');
        }

        return view('admin/Lahan/editLahan', compact('dataLahan'));
    }


    public function tambah(Request $request) {
        $data = [
            'kdLahanParkir' => $request->kdLahanParkir,
            'namaLahanParkir' => $request->namaLahanParkir,
            'totalDayaTampung' => (int)$request->totalDayaTampung
        ];

        $response = Http::post("https://rose-caterpillar-sari.cyclic.app/api/lahan-parkir", $data);
        
        if ($response->successful()) {
            toast('Data Berhasil Ditambahkan', 'success');
            return redirect('/lahan-parkir');
        } else {
            toast('Data Gagal Ditambahkan', 'error');
            return redirect('/lahan-parkir');
        }
    }
}
