<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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

    public function formTambah()
    {
        $response = Http::get('https://rose-caterpillar-sari.cyclic.app/api/alat-iot');

        // Decode response JSON
        $data = $response->json()['data'];
        return view('admin.Perangkat.tambahMaintenance', ['data' => $data]);
    }

    public function tambah(Request $request)
    {
        $data = $request->validate([
            'kdPerawatan' => 'required',
            'kdAlat' => 'required',
            'tanggalPerawatan' => 'required',
            'namaPengecek' => 'required',
            'keterangan' => 'required',
        ], [
            'kdPerawatan.required' => 'Kode Perawatan harus diisi.',
            'kdAlat.required' => 'Nama Perangkat harus diisi.',
            'tanggalPerawatan.required' => 'Tanggal Perawatan harus diisi.',
            'namaPengecek.required' => 'Nama Pengecek harus diisi.',
            'keterangan.required' => 'Keterangan harus diisi.',
        ]);

        // Upload gambar ke Firebase Storage
        if ($request->hasFile('uploadFoto')) {
            $file = $request->file('uploadFoto');

            // Inisialisasi Firebase Admin SDK
            $storage = new StorageClient([
                'projectId' => 'YOUR_PROJECT_ID',
                'keyFilePath' => '/path/to/serviceAccountKey.json' // Lokasi dari serviceAccountKey.json di server Anda
            ]);

            // Dapatkan referensi ke bucket Firebase Storage
            $bucket = $storage->bucket('YOUR_STORAGE_BUCKET_NAME');

            // Simpan file ke Firebase Storage
            $destination = 'images/' . $file->getClientOriginalName(); // Lokasi di Firebase Storage untuk menyimpan file
            $bucket->upload(
                fopen($file->getPathname(), 'r'),
                [
                    'name' => $destination
                ]
            );

            // Dapatkan URL publik ke file yang diunggah
            $imageUrl = 'https://storage.googleapis.com/YOUR_STORAGE_BUCKET_NAME/' . $destination;

            // Tambahkan URL gambar ke data yang akan dikirimkan ke API
            $data['linkFotoMaintenance'] = $imageUrl;
        }

        // Kirim data ke API
        $response = Http::post("https://rose-caterpillar-sari.cyclic.app/api/log-perawatan", $data);

        if ($response->successful()) {
            toast('Data Berhasil Ditambahkan', 'success');
            return redirect('/maintenance-iot');
        } else {
            toast('Data Gagal Ditambahkan', 'error');
            return redirect('/maintenance-iot');
        }
    }
}
