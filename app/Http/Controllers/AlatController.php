<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AlatController extends Controller
{
    public function index()
    {
        // Mendapatkan data dari API alat IoT
        $response = Http::get("https://rose-caterpillar-sari.cyclic.app/api/alat-iot");
        $datas = $response->json()['data'];

        // Mendapatkan data dari API lahan parkir
        $lahan = Http::get('https://rose-caterpillar-sari.cyclic.app/api/lahan-parkir');
        $dataL = $lahan->json()['data'];

        // Menyesuaikan data kdLahanParkir dengan namaLahanParkir
        $found = false; // Flag untuk menandai kesesuaian

        foreach ($datas as &$data) {
            foreach ($dataL as $lahan) {
                if ($data['kdLahanParkir'] === $lahan['kdLahanParkir']) {
                    $data['kdLahanParkir'] = $lahan['namaLahanParkir'];
                    $found = true; // Set flag menjadi true jika ada kesesuaian
                    break; // Jika sudah ditemukan, hentikan pencarian
                }
            }
            
            // Check apakah ada kesesuaian, jika tidak, atur nilai khusus
            if (!$found) {
                $data['kdLahanParkir'] = "Lahan Parkir Tidak ditemukan";
            }

            // Reset flag untuk iterasi selanjutnya
            $found = false;
        }

        return view('admin.Perangkat.alat', [
            "datas" => $datas
        ]);
    }


    public function formTambah()
    {
        $response = Http::get('https://rose-caterpillar-sari.cyclic.app/api/lahan-parkir');

        // Decode response JSON
        $data = $response->json()['data'];
        return view('admin.Perangkat.tambahalat', ['data' => $data]);
    } 

    public function formEdit($id)
    {
        $response = Http::get('https://rose-caterpillar-sari.cyclic.app/api/alat-iot');
        $responseLahan = Http::get('https://rose-caterpillar-sari.cyclic.app/api/lahan-parkir');
        // Decode response JSON
        $data = $response->json()['data'];
        $dataLahan = $responseLahan->json()['data'];
        // Cari data dengan ID yang sesuai
        $dataAlat = null;
        foreach ($data as $dataA) {
            if ($dataA['id'] === $id) {
                $dataAlat = $dataA;
                break;
            }
        }

        if ($dataAlat === null) {
            return redirect('/alat-iot')->with('error', 'Data tidak ditemukan');
        }

        return view('admin/Perangkat/editAlat', compact('dataAlat', 'dataLahan'));
    } 

    public function tambah(Request $request)
    {   
        $data = $request->validate([
            'kdAlat' => 'required',
            'namaLahanParkir' => 'required',
            'tanggalPasang' => 'required',
            'statusAlat' => 'required',
            'terakhirMaintenance' => 'required',
            'jadwalMaintenance' => 'required',
            'kdLahanParkir' => 'required',
        ], [
            'kdAlat.required' => 'Kode Perangkat IoT harus diisi.',
            'namaLahanParkir.required' => 'Nama Perangkat IoT harus diisi.',
            'tanggalPasang.required' => 'Tanggal Pasang harus diisi.',
            'statusAlat.required' => 'Status Alat harus dipilih.',
            'terakhirMaintenance.required' => 'Tanggal Maintenance harus diisi.',
            'jadwalMaintenance.required' => 'Jadwal Maintenance harus diisi.',
            'kdLahanParkir.required' => 'Lokasi harus dipilih.',
        ]);

        // Uncomment or remove the following line after verifying the data
        // dd($data);

        $response = Http::post("https://rose-caterpillar-sari.cyclic.app/api/alat-iot", $data);
        
        if ($response->successful()) {
            toast('Data Berhasil Ditambahkan', 'success');
            return redirect('/alat-iot');
        } else {
            toast('Data Gagal Ditambahkan', 'error');
            return redirect('/alat-iot');
        }
    }

    public function update(Request $request, $id)
    {
        $data = [
            'kdAlat' => $request->kdAlat,
            'namaLahanParkir' => $request->namaLahanParkir,
            'tanggalPasang' => $request->tanggalPasang,
            'statusAlat' => $request->statusAlat,
            'terakhirMaintenance' => $request->terakhirMaintenance,
            'jadwalMaintenance' => $request->jadwalMaintenance,
            'kdLahanParkir' => $request->kdLahanParkir,
        ];

        // dd($request->all());
        $response = Http::put("https://rose-caterpillar-sari.cyclic.app/api/alat-iot/{$id}", $data);
        
        if ($response->successful()) {
            toast('Data Berhasil Diupdate', 'success');
            return redirect('/alat-iot');
        } else {
            toast('Data Gagal Diupdate', 'error');
            return redirect('/alat-iot');
        }
    }
    public function destroy($id)
    {
        $response = Http::delete("https://rose-caterpillar-sari.cyclic.app/api/alat-iot/{$id}");
        
        if ($response->successful()) {
            alert()->success('Berhasil','Data Berhasil Dihapus');
            // toast('Data Berhasil Dihapus', 'success');
            return redirect('/alat-iot');
        } else {
            toast('Data Gagal Dihapus', 'error');
            return redirect('/alat-iot');
        }
    }
}
