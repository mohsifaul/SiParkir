<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LahanParkirController extends Controller
{
    public function dashboard(){
        $response = Http::get("https://rose-caterpillar-sari.cyclic.app/api/lahan-parkir");
        $datas = $response ->json()['data'];
        
        return view('admin/dashboard', [
            "datas" => $datas
        ]);
    }

    public function statistikUmum(Request $request) {
        try {
            $response = Http::get("https://rose-caterpillar-sari.cyclic.app/api/lahan-parkir");

            if ($response->successful()) {
                $dataLahanParkir = $response->json()['dataLahanParkir'];

                // Sesuaikan pengambilan data yang diperlukan sesuai kebutuhan untuk grafik di sisi frontend
                $data = [
                    'namaLahanParkir' => collect($dataLahanParkir)->pluck('namaLahanParkir')->toArray(),
                    'sisaLahanParkir' => collect($dataLahanParkir)->pluck('sisaTotalDayaTampung')->toArray(),
                    // Tambahkan data lain yang diperlukan untuk statistik jika ada
                ];

                return response()->json($data);
            } else {
                return response()->json(['error' => 'Failed to retrieve data'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function index() {
        $response = Http::get("https://rose-caterpillar-sari.cyclic.app/api/lahan-parkir");
        $data = $response->json();

        // Periksa apakah respons berhasil dan memiliki data
        if ($response->successful() && isset($data['data'])) {
            $datas = $data['data'];
        } else {
            // Jika respons tidak berhasil atau tidak memiliki data, atur $datas menjadi array kosong
            $datas = [];
        }

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
        $totalDayaTampung = (int)$request->totalDayaTampung;

        $data = [
            'kdLahanParkir' =>  $request->kdLahanParkir,
            'namaLahanParkir' => $request->namaLahanParkir,
            'totalDayaTampung' => $totalDayaTampung
        ];

        // Mengatur sisatotaldaya dengan nilai yang sama dengan totalDayaTampung
        $data['sisaTotalDayaTampung'] = $totalDayaTampung;

        // dd($data); // Uncomment this line to debug and check the data before sending the request

        $response = Http::post("https://rose-caterpillar-sari.cyclic.app/api/lahan-parkir", $data);

        if ($response->successful()) {
            toast('Data Berhasil Ditambahkan', 'success');
            return redirect('/lahan-parkir');
        } else {
            alert()->error('Data Invalid', 'Kode Lahan Parkir sudah ada');
            return redirect('/lahan-parkir');
        }
    }

    public function update(Request $request, $id)
    {
        $totalDayaTampung = (int)$request->totalDayaTampung;
        $data = [
            'kdLahanParkir' => $request->kdLahanParkir,
            'namaLahanParkir' => $request->namaLahanParkir,
            'totalDayaTampung' => $totalDayaTampung,
            'sisaTotalDayaTampung' => $totalDayaTampung // Menggunakan nilai totalDayaTampung untuk sisaTotalDayaTampung
        ];

        // $data['sisaTotalDayaTampung'] = $totalDayaTampung;
        // dd($data);
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
        // dd($response);
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
