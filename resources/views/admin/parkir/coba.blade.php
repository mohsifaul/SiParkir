<?php
$file = 'C:/xampp/htdocs/SiParkir/firebase_credentials.json'; // Ganti dengan path yang benar

if (file_exists($file) && is_readable($file)) {
    echo "File Firebase Credentials dapat diakses.";
} else {
    echo "File Firebase Credentials tidak dapat diakses.";
}
