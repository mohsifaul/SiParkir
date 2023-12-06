<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Google\Cloud\Firebase\Firebase;
use PHPUnit\Framework\Constraint\IsEmpty;


class MaintenanceAlat extends Controller
{
    public function index()
    {
        // Mendapatkan data dari API alat IoT
        $response = Http::get("https://rose-caterpillar-sari.cyclic.app/api/alat-iot");
        $datas = $response->json()['data'] ?? [];
    
        // Mendapatkan data dari API log perawatan
        $log = Http::get('https://rose-caterpillar-sari.cyclic.app/api/log-perawatan');
        $dataLog = $log->json()['data'] ?? [];
    
        if (!empty($dataLog)) {
            // Mendapatkan data dari API log perawatan berhasil dilakukan
            // Lakukan pemrosesan data jika 'data' ada dalam respon API
            // ...
    
            // Misalnya, melakukan penggabungan data berdasarkan kdAlat dan namaAlat
            // Lakukan pemrosesan sesuai kebutuhan aplikasi Anda
            foreach ($dataLog as &$log) {
                foreach ($datas as $data) {
                    if ($log['kdAlat'] === $data['kdAlat']) {
                        $log['kdAlat'] = $data['namaLahanParkir'];
                        break;
                    }
                }
            }
        } else {
            // Lakukan penanganan jika 'data' tidak ada dalam respon API
            // Misalnya, mengatur $dataLog ke nilai default atau memberikan pesan kepada pengguna
            $dataLog = []; // Atau nilai lain yang sesuai dengan kebutuhan aplikasi Anda
        }
    
        return view('admin.Perangkat.maintenanceAlat', [
            "dataLog" => $dataLog
        ]);
    }
    

    public function formTambah()
    {
        $response = Http::get('https://rose-caterpillar-sari.cyclic.app/api/alat-iot');

        // Decode response JSON
        $data = $response->json()['data'];
        return view('admin.Perangkat.tambahMaintenance', ['data' => $data]);
    }

    public function delete($id){
        // dd($id);
        $response = Http::delete("https://rose-caterpillar-sari.cyclic.app/api/log-perawatan/{$id}");
        // dd($response);
        
        if ($response->successful()) {
            alert()->success('Berhasil','Data Berhasil Dihapus');
            // toast('Data Berhasil Dihapus', 'success');
            return redirect('/maintenance-alat');
        } else {
            toast('Data Gagal Dihapus', 'error');
            return redirect('/maintenance-alat');
        }
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
    
            // Inisialisasi Firebase Admin SDK untuk Storage
            $storage = new StorageClient([
                'projectId' => 'siparkir-e0da3',
                'keyFilePath' => 'path/to/serviceAccountKey.json' // Lokasi dari serviceAccountKey.json di server Anda
            ]);
    
            // Dapatkan referensi ke bucket Firebase Storage
            $bucket = $storage->bucket('siparkir-e0da3.appspot.com');
    
            // Lokasi di Firebase Storage untuk menyimpan file
            $destination = 'images/' . $file->getClientOriginalName();
    
            // Simpan file ke Firebase Storage
            $bucket->upload(
                fopen($file->getPathname(), 'r'),
                [
                    'name' => $destination
                ]
            );
    
            // Dapatkan URL publik ke file yang diunggah
            $imageUrl = 'https://storage.googleapis.com/siparkir-e0da3.appspot.com/' . $destination;
    
            // Tambahkan URL gambar ke data yang akan dikirimkan ke API
            $data['linkFotoMaintenance'] = $imageUrl;
    
            // Lakukan sesuatu dengan $data, misalnya, menyimpan ke database atau menampilkan ke pengguna
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

    public function lihat(){
        
    }
}
