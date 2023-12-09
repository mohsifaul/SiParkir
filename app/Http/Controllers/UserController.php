<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Ambil data dari request
        $email = $request->input('email');
        $password = $request->input('password');

        // Lakukan permintaan ke API untuk otentikasi
        $response = Http::post('https://rose-caterpillar-sari.cyclic.app/api/user/login', [
            'email' => $email,
            'password' => $password,
        ]);

        // dd($response);
        if ($response->successful()) {
            // Jika otentikasi berhasil, simpan informasi pengguna atau token ke dalam session
            // $apiToken = $response['token'];
            // session(['api_token' => $apiToken]);

            return redirect('/dashboard');
        } else {
            // Jika otentikasi gagal, redirect kembali ke halaman login
            return redirect()->back()->with('error', 'Login gagal. Periksa kembali email dan password Anda.');
        }
    }


}
