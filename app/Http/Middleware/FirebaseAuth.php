<?php
namespace App\Http\Middleware;

use Closure;
use Kreait\Firebase\Auth;
use Illuminate\Http\Request;

class FirebaseAuth
{
    public function handle(Request $request, Closure $next)
    {
        $firebaseAuth = app('firebase.auth');
        $idToken = $request->header('Authorization');

        try {
            // Verifikasi token Firebase
            $verifiedIdToken = $firebaseAuth->verifyIdToken($idToken);
            
            // Ambil UID pengguna dari token
            $uid = $verifiedIdToken->getClaim('sub');
            
            // Disini Anda bisa menambahkan logika untuk mengecek apakah user valid berdasarkan $uid atau tidak
            return $next($request);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized.'], 401);
        }
    }
}

