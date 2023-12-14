<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
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

        // Gunakan objek autentikasi yang telah diperoleh
        $response = $this->auth->signInWithEmailAndPassword($email, $password);

        if ($response) {
            return redirect()->route('dashboard'); // Ubah 'dashboard' sesuai dengan nama route halaman dashboardmu
        }
    }
}
