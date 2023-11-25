<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MaintenanceAlat extends Controller
{
    public function index()
    {
        // Mendapatkan data dari API alat IoT
        $response = Http::get("https://rose-caterpillar-sari.cyclic.app/api/alat-iot");
        $datas = $response->json()['data'];

        // Mendapatkan data dari API log perawatan
        $log = Http::get('https://rose-caterpillar-sari.cyclic.app/api/log-perawatan');
        $dataLog = $log->json()['data'];

        // Menggabungkan data berdasarkan kdAlat dan namaAlat
        foreach ($dataLog as &$log) {
            foreach ($datas as $data) {
                if ($log['kdAlat'] === $data['kdAlat']) {
                    // Mengganti nilai kdAlat dengan namaLahanParkir dari data alat IoT
                    $log['kdAlat'] = $data['namaLahanParkir'];
                    break; // Jika sudah ditemukan, hentikan pencarian
                }
            }
        }

        return view('admin.Perangkat.maintenanceAlat', [
            "dataLog" => $dataLog // Mengirim data log perawatan yang sudah diperbarui ke view
        ]);
    }

}
