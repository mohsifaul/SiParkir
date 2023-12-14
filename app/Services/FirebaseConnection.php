<?php

namespace App\Services;

use Kreait\Firebase\Factory;

class FirebaseConnection
{
    public static function connect()
    {
        $firebase = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')));

        return $firebase->createAuth(); // Mengembalikan objek Auth
    }
}

