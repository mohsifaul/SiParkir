<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
// use GuzzleHttp\Client;

class UserController extends Controller
{
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

        try {
            $response = Http::post('https://rose-caterpillar-sari.cyclic.app/api/user', [
                'email' => $email,
                'password' => $password,
            ]);

            if ($response->status() === 200) {
                // Login berhasil
                return redirect('/dashboard');
            } else {
                // Login gagal
                return back()->with('error', 'Login gagal. Periksa kembali email dan password Anda.');
            }
        } catch (\Exception $e) {
            // Tangani kesalahan jika permintaan ke API gagal
            \Log::error('Error: ' . $e->getMessage()); // Log pesan error untuk debugging
            return back()->with('error', 'Terjadi kesalahan saat melakukan login. Silakan coba lagi.');
        }
    }

}
