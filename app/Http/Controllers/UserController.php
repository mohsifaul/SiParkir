<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use App\Services\FirebaseConnection;
// use GuzzleHttp\Client;

class UserController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi input dari form
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Ambil data dari request
        $email = $request->input('email');
        $password = $request->input('password');

        // Lakukan validasi email dan password melalui URL user
        $userValidationResponse = Http::get('https://rose-caterpillar-sari.cyclic.app/api/user', [
            'email' => $email,
            'password' => $password,
        ]);

        if ($userValidationResponse->successful()) {
            // Jika validasi email dan password sukses
            // Lakukan permintaan ke API Firebase untuk otentikasi
            $firebaseLoginResponse = Http::post('https://rose-caterpillar-sari.cyclic.app/api/user/login', [
                'email' => $email,
                'password' => $password,
            ]);

            if ($firebaseLoginResponse->successful()) {
                dd('Ini Masuk Kurang Redirect');
                // Jika otentikasi via Firebase sukses
                // Redirect ke halaman dashboard setelah berhasil login
                return redirect()->intended('/dashboard');
            }
        }

        // Jika otentikasi gagal, redirect kembali ke halaman login
        return redirect()->back()->with('error', 'Login gagal. Periksa kembali email dan password Anda.');
    }

    protected $auth;

    public function __construct()
    {
        $this->auth = FirebaseConnection::connect(); // Mendapatkan objek autentikasi dari koneksi Firebase
    }

    public function auth(Request $request)
    {
        // Ambil data dari request
        $email = $request->input('email');
        $password = $request->input('password');

        // Gunakan objek autentikasi Firebase yang telah diperoleh
        $response = $this->auth->signInWithEmailAndPassword($email, $password);

        if ($response) {
            // Jika autentikasi Firebase berhasil
            // Lakukan permintaan ke API untuk mendapatkan data pengguna berdasarkan email
            $client = new Client();

            try {
                $apiResponse = $client->request('GET', 'https://rose-caterpillar-sari.cyclic.app/api/user', [
                    'query' => ['email' => $email]
                ]);

                $statusCode = $apiResponse->getStatusCode();
                if ($statusCode === 200) {
                    $userData = json_decode($apiResponse->getBody(), true);

                    // Pastikan 'data' adalah array dan bukan null
                    if (isset($userData['data']) && !empty($userData['data'])) {
                        // Cari data yang sesuai dengan email yang di-login
                        foreach ($userData['data'] as $user) {
                            // Periksa apakah 'email' ada dan cocok dengan email login
                            if (isset($user['email']) && $user['email'] === $email) {
                                $username = $user['username'];

                                // Menggunakan informasi username sesuai kebutuhan Anda
                                // Simpan 'username' dalam session
                                session(['username' => $username]);

                                return redirect()->route('dashboard');
                            }
                        }
                    } else {
                        // Tangani jika data pengguna tidak ditemukan
                        // Misalnya, tampilkan pesan kesalahan atau tindakan yang sesuai
                    }
                }
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                // Tangani kesalahan ketika melakukan permintaan ke API
                echo "Error: " . $e->getMessage();
            }
        }
    }

    public function logout()
    {
        auth()->logout(); // Logout pengguna menggunakan Laravel Auth

        session()->invalidate(); // Invalidasi session

        session()->regenerateToken(); // Regenerasi token CSRF untuk keamanan

        return redirect('/login'); // Redirect pengguna ke halaman login setelah logout
    }

}
