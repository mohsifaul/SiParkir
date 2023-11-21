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

    public function formTambah()
    {
        $response = Http::get("https://rose-caterpillar-sari.cyclic.app/api/lahan-parkir");
        $latestId = ""; // Simpan ID terakhir dari data yang ada

        // dd($response->json());
        if ($response->successful()) {
            $data = $response->json();
            $extractedNumbers = collect($data)->pluck('kdLahanParkir')->map(function($item) {
                $extracted = intval(substr($item, 2));
                // dd($extracted); // Inspect the extracted numbers
                return $extracted;
            });
            $latestId = $extractedNumbers->max();

            $nextId = $latestId + 1;
            // dd($nextId);
            // Format ID baru dengan 'LP' dan angka diikuti dengan padding nol
            $kdLahanParkir = 'LP' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
        } else {
            // Jika tidak berhasil mendapatkan data, atur nilai default
            $kdLahanParkir = 'LP001';
        }

        return view('admin/Lahan/tambahLahan', ['kdLahanParkir' => $kdLahanParkir]);
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

    public function update(Request $request, $id)
    {
        $data = [
            'kdLahanParkir' => $request->kdLahanParkir,
            'namaLahanParkir' => $request->namaLahanParkir,
            'totalDayaTampung' => (int)$request->totalDayaTampung
        ];

        // dd($request->all());
        $response = Http::put("https://rose-caterpillar-sari.cyclic.app/api/lahan-parkir/{$id}", $data);
        
        if ($response->successful()) {
            toast('Data Berhasil Diupdate', 'success');
            return redirect('/lahan-parkir');
        } else {
            toast('Data Gagal Diupdate', 'error');
            return redirect('/lahan-parkir');
        }
    }

    public function destroy($id)
    {
        $response = Http::delete("https://rose-caterpillar-sari.cyclic.app/api/lahan-parkir/{$id}");
        
        if ($response->successful()) {
            alert()->success('Berhasil','Data Berhasil Dihapus');
            // toast('Data Berhasil Dihapus', 'success');
            return redirect('/lahan-parkir');
        } else {
            toast('Data Gagal Dihapus', 'error');
            return redirect('/lahan-parkir');
        }
    }

}
